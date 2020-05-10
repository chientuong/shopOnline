<?php

namespace App\Model;


class Cart
{
    public $product = null;
    public $totalPrice = 0;
    public $totalQuanty = 0;
    public function __construct($cart)
    {
        if($cart){
        $this->product = $cart->product;
        $this->totalPrice = $cart->totalPrice;
        $this->totalQuanty = $cart->totalQuanty;
        }
    }
    public function addCart($product,$prodId)
    {
        $newProd = ['quanty'=>0,'price'=>$product->prod_price,'infoProd'=>$product];

        if($this->product){
            if(array_key_exists($prodId,$this->product)){
                $newProd = $this->product[$prodId];
            }
        }

        $newProd['quanty']++;
        $newProd['price']=$product->prod_price*$newProd['quanty'];

        $this->product[$prodId]=$newProd;
        $this->totalPrice += $product->prod_price;
        $this->totalQuanty++;
        // dd($newProd);
    }
    public function deleteItemCart($prodId)
    {
       $this->totalQuanty -= $this->product[$prodId]['quanty'];
       $this->totalPrice -= $this->product[$prodId]['price'];
       unset($this->product[$prodId]);
    }
    public function addQuanty($prodId)
    {
        $this->product[$prodId]['quanty']++;
        $this->product[$prodId]['price'] += $this->product[$prodId]['infoProd']['prod_price'];
        $this->totalPrice += $this->product[$prodId]['infoProd']['prod_price'];
        $this->totalQuanty++;
    }
    public function subtractQuanty($prodId)
    {
        $this->product[$prodId]['quanty']--;
        $this->product[$prodId]['price'] -= $this->product[$prodId]['infoProd']['prod_price'];
        $this->totalPrice -= $this->product[$prodId]['infoProd']['prod_price'];
        $this->totalQuanty--;
    }
}
