<?php
/**
 * Kontroler uvodni stranky webu.
 */
class Uvod{

    /**
     * Ziskani dat stranky.
     * @return array    Pole dat.
     */
    public function vratData(){
        // ziskani textu nadpisu i stranky
        $nadpis = "Úvodní stránka";
        $text = "Dlouhý nesmyslný text. <b>Lorem ipsum</b> dolor sit amet, consectetuer adipiscing elit. Nullam sit amet magna in magna gravida vehicula. Vivamus luctus egestas leo. Aenean id metus id velit ullamcorper pulvinar. Pellentesque sapien. Maecenas lorem. In convallis. Etiam commodo dui eget wisi. Pellentesque pretium lectus id turpis. Curabitur sagittis hendrerit ante. Vestibulum fermentum tortor id mi. Etiam posuere lacus quis dolor. In enim a arcu imperdiet malesuada. Nullam at arcu a est sollicitudin euismod. Vivamus porttitor turpis ac leo. Phasellus et lorem id felis nonummy placerat. Maecenas libero. Maecenas ipsum velit, consectetuer eu lobortis ut, dictum at dui. Maecenas lorem. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Quisque porta. Nullam dapibus fermentum ipsum. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Duis sapien nunc, commodo et, interdum suscipit, sollicitudin et, dolor. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Aliquam erat volutpat. In laoreet, magna id viverra tincidunt, sem odio bibendum justo, vel imperdiet sapien wisi sed libero. Duis condimentum augue id magna semper rutrum. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus. Mauris suscipit, ligula sit amet pharetra semper, nibh ante cursus purus, vel sagittis velit mauris vel metus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Pellentesque arcu. In dapibus augue non sapien. Etiam posuere lacus quis dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer malesuada. Phasellus enim erat, vestibulum vel, aliquam a, posuere eu, velit. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus. Pellentesque pretium lectus id turpis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris elementum mauris vitae tortor.";
        // vracim data
        return array("nadpis"=>$nadpis, "text"=>$text);
    }

}
?>