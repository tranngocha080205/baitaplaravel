<?php

namespace App\Models;

class Cart
{
    public $items = [];
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart = null)
    {
        if ($oldCart) {
            $this->items = $oldCart->items ?? [];
            $this->totalQty = $oldCart->totalQty ?? 0;
            $this->totalPrice = $oldCart->totalPrice ?? 0;
        }
    }

    // Lấy giá áp dụng (khuyến mãi nếu có)
    protected function getPrice($item)
    {
        return $item->promotion_price > 0 ? $item->promotion_price : $item->unit_price;
    }

    public function add($item, $id)
    {
        $price = $this->getPrice($item);

        if (isset($this->items[$id])) {
            $giohang = $this->items[$id];
        } else {
            $giohang = [
                'qty' => 0,
                'price' => 0,
                'item' => $item
            ];
        }

        $giohang['qty']++;
        $giohang['price'] = $price * $giohang['qty'];

        $this->items[$id] = $giohang;
        $this->totalQty++;
        $this->totalPrice += $price;
    }

    // Giảm 1 sản phẩm
    public function reduceByOne($id)
    {
        if (!isset($this->items[$id])) return;

        $price = $this->getPrice($this->items[$id]['item']);

        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $price;

        $this->totalQty--;
        $this->totalPrice -= $price;

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    // Xóa hẳn sản phẩm
    public function removeItem($id)
    {
        if (!isset($this->items[$id])) return;

        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];

        unset($this->items[$id]);
    }
}
