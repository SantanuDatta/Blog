<div class="search-popup">
	<!-- close button -->
	<button type="button" class="btn-close" aria-label="Close"></button>
	<!-- content -->
	<div class="search-content">
		<div class="text-center">
			<h3 class="mb-4 mt-0">Press ESC to close</h3>
		</div>
		<!-- form -->
		<form class="d-flex search-form" action="{{ route('search.posts') }}" method="POST">
            @csrf
			<input class="form-control me-2" name="searchContent" type="search" placeholder="Search and press enter ..." aria-label="Search">
            
			<button class="btn btn-default btn-lg" name="search" type="submit"><i class="icon-magnifier"></i></button>
		</form>
	</div>
</div>