<?php
namespace app\Modules;

class Menu implements \f3il\Module{
    private static $item = [
        [
            "title" => "Home",
            "url"   => "#",
        ],[
            "title" => "Menu 1",
            "url"   => "#"
        ],[
            "title" =>"Menu 2",
            "url"   =>"#"
        ]
        ];
    public function render()
    {
?>
<div>
    <ul>
        <?php foreach(self::$item as $M):?>
        <li style="display: inline-block;">
        <a href="<?php echo $M['url'];?>">
            <?php echo $M['title'];?>
        </a>
        
        </li>
        <?php endforeach; ?>
    </ul>
</div>
    <?php  
    }
}
