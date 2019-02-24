<?php
/**
 * Created by PhpStorm.
 * User: javie
 * Date: 27/01/2019
 * Time: 12:46 PM
 */

class GildedRose {

    private $items;
    const MAX_QUALITY = 50;
    const MIN_QUALITY = 0;
    const AFTER_CONCERT = 0;
    private $products = array(
        'aged'=> 'Aged Brie',
        'sulfuras' => 'Sulfuras, Hand of Ragnaros',
        'backstage' => 'Backstage passes to a TAFKAL80ETC concert',
        'conjured' => 'Conjured Mana Cake'
    );

    function __construct($items) {
        $this->items = $items;
    }

    function update_quality() {
        foreach ($this->items as $item) {
            $type = array_search($item->name, $this->products);
            //echo "type:" . $type . "\n";
            $this->process_update_quality($type, $item);
        }
    }

    private function process_update_quality($type, $item){
        if($type != "sulfuras"){
            $this->processSell($type, $item);
            $this->processQuality($type, $item);
        }
    }

    private function processSell($type, $item){
        $less_sell = 1;
        if($type == "conjured"){
            $less_sell = 2;
        }
        $item->sell_in -=  $less_sell;
        if($item->sell_in < self::AFTER_CONCERT){
            $item->quality = self::MIN_QUALITY;
        }
    }


}

class Item {

    public $name;
    public $sell_in;
    public $quality;

    function __construct($name, $sell_in, $quality) {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

}
