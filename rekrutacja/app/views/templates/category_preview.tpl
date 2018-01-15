{include file="header.tpl"}

<div class="container">
   <div class="row">
      <div class="col-xs-12 col-sm-8 col-xs-push-2">
         <div class="panel panel-default">
            <div class="panel-heading">Podgląd kategorii</div>
            <div class="panel-body">
               <p>&nbsp;</p>


               <p><strong>Nazwa kategorii:</strong> {$category->category}</p>
               <p><strong>Opis:</strong> {$category->description}<br>Utworzona: {$category->created_at|date_format:"%Y-%m-%d"}</p>

               <p class="text-center"><a href="{$base_url}driverlicenses/index" class="btn btn-default">powrót do listy</a></p>
            </div>
         </div>
      </div>
   </div>

</div>

{include file="footer.tpl"}