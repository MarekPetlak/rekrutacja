{include file="header.tpl"}

<div class="container">
   <div class="row">
      <div class="col-xs-12 col-sm-8 col-xs-push-2">
         <div class="panel panel-default">
            <div class="panel-heading">Podgląd użytkownika</div>
            <div class="panel-body">
               <p>&nbsp;</p>


               <p><strong>Imię:</strong> {$user->fname}</p>
               <p><strong>Nazwisko:</strong> {$user->lname}</p>
               <p><strong>Utworzony:</strong> {$user->created_at|date_format:"%Y-%m-%d"}</p>
               <p><strong>Kategorie uprawnień:</strong></p>

               <ul>
                  {foreach from=$user_licenses item=license}
                     <li title="{$license->description}">kat. {$license->category}</li>
                     {/foreach}
               </ul>

               <p class="text-center"><a href="{$base_url}users/index" class="btn btn-default">powrót do listy</a></p>
            </div>
         </div>
      </div>
   </div>

</div>

{include file="footer.tpl"}