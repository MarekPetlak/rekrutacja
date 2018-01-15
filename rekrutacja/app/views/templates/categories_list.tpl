{include file="header.tpl"}

<div class="container">

   {include file="menu.tpl" title=$mode}

   <div class="row">
      <form class="form-inline col-xs-12 col-sm-9" role="form" method="GET">
         <div class="form-group">
            <label for="search">Lista kategorii:</label>
            <input type="text" class="form-control ui-autocomplete-input" name="search" id="search" autocomplete="off">
         </div>
      </form>

      <div class="col-xs-12 col-xs-3 text-right">
         <a href="{$base_url}driverlicenses/edit" class="btn btn-default">dodaj kategorię</a>
      </div>
   </div>

   <div class="row">
      <div class="col-xs-12">
         <p>&nbsp;</p>

         <table class="table table-hover table-bordered table-striped">
            <thead>
               <tr>
                  <th>l.p.</th>
                  <th>kategoria</th>
                  <th>opis</th>
                  <th>utworzono</th>
                  <th>akcje</th>
               </tr>
            </thead>

            <tbody>
               {foreach from=$categories item=category}
                  <tr id="row-{$category->id}">
                     <td>{$category->id}</td>
                     <td>{$category->category}</td>
                     <td>{$category->description}</td>
                     <td>{$category->created_at->format('Y-m-d H:i:s')}</td>
                     <td>
                        <a href="{$base_url}driverlicenses/preview/{$category->id}" class="btn btn-info">szczegóły <span class="glyphicon glyphicon-user"></span></a>
                        <a href="{$base_url}driverlicenses/edit/{$category->id}" class="btn btn-default">edytuj <span class="glyphicon glyphicon-edit"></span></a>
                        <a onClick="return deleteData({$category->id}, 'categories')" class="btn btn-warning">usuń <span class="glyphicon glyphicon-trash"></span></a>
                     </td>
                  </tr>
               {/foreach}
            </tbody>
         </table>

         <p class="text-center">wszystkich kategorii: {$categories_counter}<strong></strong></p>
         {if $pagination_counter > 1}
            <nav class="text-center">
               <ul class="pagination">
                  {for $iterator=1 to $pagination_counter}
                     {if ($iterator == 1)}
                        <li><a href="{$base_url}driverlicenses/index">1</a></li>
                        {else}
                        <li><a href="{$base_url}driverlicenses/index/{$iterator}">{$iterator}</a></li>
                        {/if}
                     {/for}
               </ul>
            </nav>
         {/if}

      </div>
   </div>
</div>

{include file="footer.tpl"}