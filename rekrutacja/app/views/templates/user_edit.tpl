{include file="header.tpl"}

<div class="container">
   <div class="row">
      <div class="col-xs-12 col-sm-8 col-xs-push-2">
         <div class="panel panel-default">
            <div class="panel-heading">Formularz dodawania użytkownika</div>
            <div class="panel-body">
               <p>&nbsp;</p>

               <form role="form" id="user" novalidate="novalidate">
                  <input type="hidden" name="id" value="{$user->id}">

                  <div class="form-group">
                     <label for="fname">Imię:</label>
                     <input type="text" class="form-control ucfirst" id="fname" name="fname" placeholder="tu wpisz swoje imię" value="{$user->fname}" required>
                  </div>

                  <div class="form-group">
                     <label for="lname">Nazwisko:</label>
                     <input type="text" class="form-control ucfirst" id="lname" name="lname" placeholder="tu wpisz swoje lname" value="{$user->lname}" required>
                  </div>

                  <div class="form-group">
                     <label for="created_at">Data:</label>
                     <input type="text" class="form-control" id="created_at" name="created_at" value="{if isset($user->created_at)}{$user->created_at|date_format:"%Y-%m-%d"}{else}{$smarty.now|date_format:"%Y-%m-%d"}{/if}" required>
                  </div>
                  <div class="row">

                     {foreach from=$categories item=category}
                        <div class="col-xs-6 col-xs-4">
                           <div class="checkbox">
                              {{assign var="checked" value="unchecked"}}
                              {foreach from=$user_licenses item=license}
                                 
                                 {if $license->driverlicense_id eq $category->id}
                                    {assign var="checked" value="checked"}
                                 {/if}
                              {/foreach}
                              <label><input type="checkbox" name="category[]" value="{$category->id}" {$checked}>kat. {$category->category}</label>
                           </div>
                        </div>
                     {/foreach}
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