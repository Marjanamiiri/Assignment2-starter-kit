<?php require_once 'head.php'; ?>
<body>
	<?php require_once 'header.php'; ?>

	<div class="mx-auto max-w-4xl sm:px-6 lg:px-8 mt-10">
		<form class="space-y-8" action="/settings" method="post" enctype="multipart/form-data">
			<h1 class="text-base font-semibold leading-7 text-gray-900">Settings</h1>

			<div>
				<label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email (cannot be changed)</label>
				<input id="email" name="email" type="email" disabled value="<?php echo $user->email; ?>" class="block w-full rounded-md border-0 px-2 py-1.5 mt-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
			</div>

			<div>
				<label for="name" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
				<input id="name" name="name" type="text" required value="<?php echo $user->name; ?>" class="block w-full rounded-md border-0 px-2 py-1.5 mt-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
			</div>

			<div>
				<label for="profile_picture" class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
				<div class="flex mt-2">
					<img class="h-10 w-10 mr-2 rounded-full cover" src="<?php echo image($user->profile_picture); ?>" alt="" />
					<input id="profile_picture" name="profile_picture" type="file" value="<?php echo $user->profile_picture; ?>" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
				</div>
			</div>

			<div class="mt-6 flex items-center justify-end gap-x-6">
				<button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
			</div>

		</form>
	</div>
</body>