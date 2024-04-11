

 <form action="./" method="get"  class="d-flex form-floating search-form"  style="margin-top: 2rem;"> 
	
	<input type="text" class="form-control me-2 search-field" name="s" id="search" placeholder="Search..." value="<?php the_search_query(); ?>" />
	  <label id="search-label" for="search">Search...</label>
	<button type="submit" class="btn btn-success search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
</form>




<!-- <div id="sb-search" class="sb-search">
						<form action="./" method="get" class="search-form">
							
							<input type="text" class="sb-search-input" name="s" id="search" placeholder="Search..." value="<?php //the_search_query(); ?>" />
							 
							<input class="sb-search-submit" type="submit" value="">
							<span class="sb-icon-search"></span>
						</form>
					</div>
 -->
