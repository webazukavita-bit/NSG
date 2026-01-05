<?php

namespace App\Services;

class SolarCalculationService
{
    private const AREA_PER_KW = 100; // sq ft
    private const PANEL_AREA = [
        330 => 20.86,
        550 => 35.5,
        600 => 38.5,
    ];
    private const ANNUAL_EFFICIENCY_LOSS = 0.15; // 15% degradation/loss

    public function calculateResidential($data, $state)
    {
        $monthlyConsumption = $data['monthly_consumption'] ?? ($data['monthly_bill'] / 7); // Avg ₹7 per unit
        $desiredCapacity = $data['desired_capacity'] ?? $this->capacityFromConsumption($monthlyConsumption);
        
        return $this->buildCalculationResult(
            $desiredCapacity,
            $monthlyConsumption,
            $state,
            $data['panel_wattage'],
            'residential'
        );
    }

    public function calculateCommercial($data, $state)
    {
        $monthlyConsumption = $data['monthly_consumption'] ?? ($data['monthly_bill'] / 8); // Avg ₹8 per unit
        $desiredCapacity = $data['desired_capacity'] ?? $this->capacityFromConsumption($monthlyConsumption);
        
        $result = $this->buildCalculationResult(
            $desiredCapacity,
            $monthlyConsumption,
            $state,
            $data['panel_wattage'],
            'commercial'
        );

        // Commercial subsidy logic
        $result['central_subsidy'] = 0; // No central subsidy for commercial
        $result['state_subsidy'] = $this->getStateSubsidy($state, 'commercial');
        $result['total_subsidy'] = $result['state_subsidy'];
        $result['effective_cost'] = $result['installation_cost'] - $result['total_subsidy'];

        return $result;
    }

    public function calculateIndustrial($data, $state)
    {
        $monthlyConsumption = $data['monthly_consumption'] ?? ($data['monthly_bill'] / 10); // Avg ₹10 per unit
        $desiredCapacity = $data['desired_capacity'] ?? $this->capacityFromConsumption($monthlyConsumption);

        // Industrial systems are typically larger
        $minCapacity = 100; // Minimum 100 kW
        $maxCapacity = 500; // Maximum 500 kW for subsidy
        $desiredCapacity = max($minCapacity, min($desiredCapacity, $maxCapacity));

        $result = $this->buildCalculationResult(
            $desiredCapacity,
            $monthlyConsumption,
            $state,
            $data['panel_wattage'],
            'industrial'
        );

        // Industrial subsidy logic
        $result['central_subsidy'] = 0; // No central subsidy for industrial
        $result['state_subsidy'] = $this->getStateSubsidy($state, 'industrial');
        $result['total_subsidy'] = $result['state_subsidy'];
        $result['effective_cost'] = $result['installation_cost'] - $result['total_subsidy'];
        $result['industrial_benefits'] = [
            'tax_depreciation' => $result['installation_cost'] * 0.40,
            'electricity_duty_waiver' => true,
            'net_metering' => true,
        ];

        return $result;
    }

    private function buildCalculationResult($capacity, $consumption, $state, $panelWattage, $type)
    {
        $panelCount = ($capacity * 1000) / $panelWattage;
        $areaRequired = $capacity * self::AREA_PER_KW;
        
        // Monthly generation (kWh)
        $monthlyGeneration = $capacity * $state->solar_irradiance * 30 * (1 - self::ANNUAL_EFFICIENCY_LOSS);
        $annualGeneration = $monthlyGeneration * 12;

        // Cost calculation
        $costPerKw = match(true) {
            $capacity <= 5 => 60000,
            $capacity <= 10 => 55000,
            default => 50000,
        };

        $installationCost = $capacity * $costPerKw;

        // Savings calculation
        $electricityRate = match($type) {
            'residential' => 7,
            'commercial' => 8,
            'industrial' => 10,
        };

        $monthlySavings = $monthlyGeneration * $electricityRate;
        $annualSavings = $monthlySavings * 12;
        $paybackMonths = $installationCost / $monthlySavings;
        $savingsIn25Years = $annualSavings * 25;

        // CO2 reduction (kg per kWh)
        $co2PerKwh = 0.67;
        $annualCo2Reduction = $annualGeneration * $co2PerKwh;

        return [
            'system_capacity_kw' => round($capacity, 2),
            'monthly_consumption' => round($consumption, 2),
            'panel_count' => round($panelCount),
            'panel_wattage' => $panelWattage,
            'area_required_sqft' => round($areaRequired, 2),
            'area_required_sqm' => round($areaRequired / 10.764, 2),
            'monthly_generation_kwh' => round($monthlyGeneration, 2),
            'annual_generation_kwh' => round($annualGeneration, 2),
            'installation_cost' => round($installationCost, 2),
            'central_subsidy' => $this->getCentralSubsidy($capacity, $type),
            'monthly_savings' => round($monthlySavings, 2),
            'annual_savings' => round($annualSavings, 2),
            'payback_period_months' => round($paybackMonths, 1),
            'savings_25_years' => round($savingsIn25Years, 2),
            'co2_reduction_annual' => round($annualCo2Reduction, 2),
            'solar_irradiance' => $state->solar_irradiance,
        ];
    }

    private function capacityFromConsumption($consumption)
    {
        // 1 kW generates ~120 kWh per month (4 units/day)
        return $consumption / 120;
    }

    private function getCentralSubsidy($capacity, $type)
    {
        if ($type === 'residential') {
            if ($capacity <= 3) {
                return $capacity * 50000; // ₹50,000 per kW up to 3 kW
            } else if ($capacity <= 10) {
                return (3 * 50000) + (($capacity - 3) * 30000); // ₹30,000 per kW for 3-10 kW
            }
        }
        return 0;
    }

    private function getStateSubsidy($state, $type)
    {
        // This would be pulled from database in real implementation
        $subsidies = [
            'residential' => $state->id * 5000, // Mock data
            'commercial' => 0,
            'industrial' => $state->id * 1000,
        ];
        return $subsidies[$type] ?? 0;
    }
}