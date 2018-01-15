   <nav class=" navbar navbar-default">
      <div class="container-fluid">

         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-top" aria-expanded="false">
               <span class="sr-only">Rozwiń menu</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
         </div>

         <div class="collapse navbar-collapse" id="menu-top">
            <ul class="nav navbar-nav">
               <li {if $mode eq 'driverlicenses'} class="active" {/if}><a href="{$base_url}driverlicenses/index">kategorie</a></li>
               <li {if $mode eq 'users'} class="active" {/if}><a href="{$base_url}users/index">użytkownicy</a></li>
            </ul>
         </div>
         
      </div>
   </nav>

