<?php require_once 'head.php'; ?>
<body>
	<?php require_once 'header.php'; ?>

	<div class="mx-auto max-w-4xl sm:px-6 lg:px-8 mt-10">
		<form class="space-y-8" action="/articles/store" method="POST">
			<h1 class="text-base font-semibold leading-7 text-gray-900">New Article</h1>
			<div class="col-span-full">
				<label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
				<input id="title" name="title" type="text" required class="block w-full rounded-md border-0 px-2 py-1.5 mt-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
			</div>

			<div class="col-span-full">
				<label for="url" class="block text-sm font-medium leading-6 text-gray-900">URL</label>
				<input id="url" name="url" type="text" required class="block w-full rounded-md border-0 px-2 py-1.5 mt-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
			</div>

			<div class="mt-6 flex items-center justify-end gap-x-6">
				<button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
			</div>
		</form>
	</div>
</body>