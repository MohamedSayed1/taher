<?php

namespace App\Exports;

use App\Models\TheorySubscription;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TheorySubscriptionExport implements FromCollection, WithMapping, WithHeadings
{
    private $theory_package_id;

    public function __construct($id = 0)
    {
        $this->theory_package_id = $id;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TheorySubscription::where('theory_package_id', $this->theory_package_id)->get();
    }

    public function headings(): array
    {
        return [
            'الأسم',
            'الوتساب',
            'البريد الألكتروني',
            'تاريخ الأشتراك',
            'تاريخ الأنتهاء',

        ];
    }

    public function map($subscribtion): array
    {
        return [
            ($subscribtion->user) ? $subscribtion->user->name : null,
            $subscribtion->whatsapp,
            ($subscribtion->user) ? $subscribtion->user->email : null,
            $subscribtion->subscription_date,
            $subscribtion->expiration_date,

        ];
    }
}
