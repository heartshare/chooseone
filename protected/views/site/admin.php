<style>
    #conrlink{text-decoration:none; text-align:center;
        padding:11px 32px;
        border:solid 1px #647075;
        -webkit-border-radius:4px;
        -moz-border-radius:4px;
        border-radius: 4px;
        font:14px Arial, Helvetica, sans-serif;
        font-weight:bold;
        color:#1e2121;
        background-color:#8d9a9e;
        background-image: -moz-linear-gradient(top, #8d9a9e 0%, #96a0a3 100%);
        background-image: -webkit-linear-gradient(top, #8d9a9e 0%, #96a0a3 100%);
        background-image: -o-linear-gradient(top, #8d9a9e 0%, #96a0a3 100%);
        background-image: -ms-linear-gradient(top, #8d9a9e 0% ,#96a0a3 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#96a0a3', endColorstr='#96a0a3',GradientType=0 );
        background-image: linear-gradient(top, #8d9a9e 0% ,#96a0a3 100%);
        -webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
        -moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;
        box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;

        text-shadow: 2px 0px 2px #bababa;
        filter: dropshadow(color=#bababa, offx=2, offy=0); }
    #conrlink:hover{
     padding:11px 32px;
     border:solid 1px #005072;
        -webkit-border-radius:4px;
        -moz-border-radius:4px;
        border-radius: 4px;
        font:14px Arial, Helvetica, sans-serif;
        font-weight:bold;
        color:#1e2121;
        background-color:#3ba4c7;
        background-image: -moz-linear-gradient(top, #3ba4c7 0%, #1982a5 100%);
        background-image: -webkit-linear-gradient(top, #3ba4c7 0%, #1982a5 100%);
        background-image: -o-linear-gradient(top, #3ba4c7 0%, #1982a5 100%);
        background-image: -ms-linear-gradient(top, #3ba4c7 0% ,#1982a5 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1982a5', endColorstr='#1982a5',GradientType=0 );
        background-image: linear-gradient(top, #3ba4c7 0% ,#1982a5 100%);
        -webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
        -moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;
        box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;

        text-shadow: 2px 0px 2px #bababa;
        filter: dropshadow(color=#bababa, offx=2, offy=0);}
#controll{
    margin-left: 200px;

}
 #controll div{
     margin-left: 15px;
    float: left;

}
 #contrilnk{
     color: #f5f5f5;
 }
</style>

<div id="controll">
    <?php echo CHtml::link("Фільми",array('films/admin'),array('id'=>'conrlink'));?>
    <?php echo CHtml::link("Книги",array('books/admin'),array('id'=>'conrlink'));?>
    <?php echo CHtml::link("Ігри",array('games/admin'),array('id'=>'conrlink'));?>
    <?php echo CHtml::link("Користувачі",array('site/users'),array('id'=>'conrlink'));?>
</div>