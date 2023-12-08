<?php require_once 'head.php' ?>
<body>
	<div class="card w-96 bg-base-100 bg-slate-900 mx-auto mt-20">
		<div class="card-body">
			<h2 class="card-title text-white mx-auto">Register</h2>
			<form class="space-y-6 py-8" action="/register" method="POST">
				<div>
					<label for="name" class="block text-white">Name</label>
					<input id="name" name="name" type="text" placeholder="Your name" autocomplete="name" required value="<?php echo (isset($name)) ? $name : ''; ?>" class="input input-bordered mt-1 w-full max-w-xs" />
				</div>

				<?php if (isset($errors['email'])): ?>
					<div class="bg-red-100 border-l-4 border-red-500 rounded text-red-700 p-4" role="alert">
						<p><?php echo $errors['email']; ?></p>
					</div>
				<?php endif; ?>

				<div>
					<label for="email" class="block text-white">Email address</label>
					<input id="email" name="email" type="email" placeholder="Your email" autocomplete="email" required value="<?php echo (isset($email)) ? $email : ''; ?>" class="input input-bordered mt-1 w-full max-w-xs" />
				</div>

				<?php if (isset($errors['password'])): ?>
					<div class="bg-red-100 border-l-4 border-red-500 rounded text-red-700 p-4" role="alert">
						<p><?php echo $errors['password']; ?></p>
					</div>
				<?php endif; ?>

				<div>
					<label for="password" class="block text-white">Password</label>
					<input id="password" name="password" type="password" placeholder="Your password" autocomplete="current-password" required class="input input-bordered mt-1 w-full max-w-xs" />
				</div>

				<div class="flex items-center justify-between">
					<div class="flex items-center text-white">
						Already have an account?&nbsp;&nbsp;
						<a href="/login" class="font-medium text-indigo-600 hover:text-indigo-500">Log in</a>
					</div>
				</div>

				<button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Register</button>
			</form>
		</div>
	</div>
</body>