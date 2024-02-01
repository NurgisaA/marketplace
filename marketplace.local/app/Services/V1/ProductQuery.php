<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class ProductQuery
{
    protected array $safeParams = [
        'title' => ["eq", "like"],
        'description'=> ["like"],
        'price' => ["eq", "gt", "lt"],
        'categoryId' => ["eq"]
    ];

    protected array $columnMap = [
        'title' => 'title',
        'description' => 'description',
        'price' => 'price',
        'categoryId' => 'category_id'
    ];

    protected array $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'like' => 'like'
    ];

    protected array $defaultOrder = ['id', 'asc'];
    private array $safeOrderParams = [
        'title' => ["asc", "desc"],
        'price' => ["asc", "desc"],
    ];

    public function transform(Request $request)
    {
        $eloQuery = [];
        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);
            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    if ($operator == 'like') {
                        $query[$operator] = "%{$query[$operator]}%";
                    }
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }

    public function transformOrder(Request $request)
    {
        $orderBy = $request->query('_orderBy');
        foreach ($this->safeOrderParams as $param => $operators) {
            if (isset($orderBy[$param])) {
                $column = $this->columnMap[$param];
                $direction = $orderBy[$param];
                return [$column, $direction];
            }
        }

        return $this->defaultOrder;

    }
}
