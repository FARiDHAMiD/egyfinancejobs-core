<?php

namespace Database\Seeders;
use App\Models\EmployeeAchievement;
use Illuminate\Database\Seeder;

class EmployeeAchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $achievements = [
            "Successfully managed a team of 10 accountants to complete monthly closing in record time",
            "Implemented a new financial reporting system that reduced errors by 30%",
            "Negotiated a 10% reduction in vendor pricing resulting in $500k in annual savings",
            "Developed and implemented a new budgeting process that improved forecasting accuracy by 20%",
            "Achieved a 15% increase in sales revenue through a targeted marketing campaign",
            "Managed the successful acquisition of a competitor company, resulting in a 25% increase in market share",
            "Reduced the company's tax liability by 20% through careful tax planning and strategy",
            "Developed and delivered a comprehensive training program that improved staff productivity by 25%",
            "Successfully negotiated a partnership with a major client, resulting in a $1M increase in revenue",
            "Developed and implemented a new inventory management system that reduced waste by 40%",
            "Improved cash flow by implementing more efficient payment and collection processes",
            "Developed and implemented a cost allocation model that improved budget accuracy by 30%",
            "Designed and implemented a new customer relationship management system that improved customer satisfaction by 15%",
            "Successfully managed a company-wide cost-cutting initiative resulting in $2M in annual savings",
            "Developed and implemented a new project management process that improved project delivery times by 20%",
            "Successfully implemented an enterprise resource planning (ERP) system that improved efficiency and reduced costs",
            "Developed and implemented a new performance appraisal system that improved staff retention by 25%",
            "Managed a successful initial public offering (IPO) resulting in $50M in capital raised",
            "Successfully negotiated a debt restructuring plan that improved cash flow and reduced debt by 20%",
            "Managed the successful launch of a new product line resulting in a 10% increase in market share",
            "Developed and implemented a new quality assurance process that reduced defects by 20%",
            "Designed and implemented a new employee benefit program that improved staff satisfaction and retention",
            "Successfully led the company through a major regulatory compliance audit with no findings",
            "Implemented a new data analytics system that improved financial forecasting accuracy by 25%",
            "Successfully managed a company-wide restructuring resulting in improved efficiency and cost savings",
            "Developed and implemented a new performance-based compensation plan that improved staff motivation and productivity",
            "Managed the successful merger of two companies resulting in a 30% increase in revenue",
            "Successfully managed a major international expansion resulting in increased market share and revenue growth",
            "Designed and implemented a new cost accounting system that improved product profitability analysis",
            "Developed and implemented a new risk management process that reduced risk exposure by 30%"
        ];
        
        for ($i=2; $i <= 31; $i++) {
            EmployeeAchievement::create([
                'employee_id' => $i,
                'description' => $achievements[$i-2],
            ]);
        }
    }
}
