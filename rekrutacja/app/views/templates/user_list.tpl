{include file="header.tpl"}

<div class="container">

   {include file="menu.tpl" title=$mode}

   <div class="row">
      <form class="form-inline col-xs-12 col-sm-9" id="search-form" role="form" method="GET" action="{$base_url}users/index">
         <div class="form-group">
            <label for="search">Lista użytkowników:</label>
            <input type="text" class="form-control ui-autocomplete-input" name="search" id="search" autocomplete="off">
         </div>
      </form>

      <div class="col-xs-12 col-xs-3 text-right">
         <a href="{$base_url}user/edit" class="btn btn-default">dodaj użytkownika</a>
      </div>
   </div>

   <div class="row">
      <div class="col-xs-12">
         <p>&nbsp;</p>

         <table class="table table-hover table-bordered table-striped">
            <thead>
               <tr>
                  <th>l.p.</th>
                  <th>imię</th>
                  <th>nazwisko</th>
                  <th>utworzono</th>
                  <th>akcje</th>
               </tr>
            </thead>

            <tbody>
               {foreach from=$users item=user}
                  <tr id="row-{$user->id}">
                     <td>{$user->id}</td>
                     <td>{$user->fname}</td>
                     <td>{$user->lname}</td>
                     <td>{$user->created_at->format('Y-m-d H:i:s')}</td>
                     <td>
                        <a href="{$base_url}users/preview/{$user->id}" class="btn btn-info">szczegóły <span class="glyphicon glyphicon-user"></span></a>
                        <a href="{$base_url}users/edit/{$user->id}" class="btn btn-default">edytuj <span class="glyphicon glyphicon-edit"></span></a>
                        <a onClick="return deleteData({$user->id}, 'users')" class="btn btn-warning">usuń <span class="glyphicon glyphicon-trash"></span></a>
                     </td>
                  </tr>
               {/foreach}
            </tbody>
         </table>

         <p class="text-center">wszystkich użytkowników: {$user_counter}<strong></strong></p>
         {if $pagination_counter > 1}
            <nav class="text-center">
               <ul class="pagination">
                  {for $iterator=1 to $pagination_counter}
                     {if ($iterator == 1)}
                        <li><a href="{$base_url}users/index">1</a></li>
                        {else}
                        <li><a href="{$base_url}users/index/{$iterator}">{$iterator}</a></li>
                        {/if}
                     {/for}
               </ul>
            </nav>
         {/if}

      </div>
   </div>
</div>

{include file="footer.tpl"}