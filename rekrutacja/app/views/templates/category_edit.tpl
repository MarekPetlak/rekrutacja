{include file="header.tpl"}

<div class="container">
   <div class="row">
      <div class="col-xs-12 col-sm-8 col-xs-push-2">
         <div class="panel panel-default">
            <div class="panel-heading">Formularz dodawania kategorii</div>
            <div class="panel-body">
               <p>&nbsp;</p>

               <form role="form" id="driverlicense" novalidate="novalidate">
                  <input type="hidden" name="id" value="{$category->id}">

                  <div class="form-group">
                     <label for="category">Nazwa:</label>
                     <input type="text" class="form-control" id="category" name="category" placeholder="tu wpisz nazwę" value="{$category->category}" required>
                  </div>

                  <div class="form-group">
                     <label for="description">Opis:</label>
                     <textarea class="form-control" id="description" name="description" placeholder="tu podaj description" rows="10">{$category->description}</textarea>
                  </div>

                  <div class="form-group">
                     <label for="data">Data:</label>
                     <input type="text" class="form-control" id="data" name="created_at" value="{if isset($category->created_at)}{$category->created_at|date_format:"%Y-%m-%d"}{else}{$smarty.now|date_format:"%Y-%m-%d"}{/if}" required>
                  </div>

                  <p class="text-center">
                     <input type="button" id="save" value="zapisz" class="btn btn-default">
                  </p>
               </form>

            </div>
         </div>
      </div>
   </div>

</div>

{include file="footer.tpl"}