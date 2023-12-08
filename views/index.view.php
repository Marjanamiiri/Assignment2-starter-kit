<?php use src\Repositories\ArticleRepository; ?>
<?php require_once 'head.php'; ?>
<body>
	<?php require_once 'header.php' ?>

	<div class="mx-auto max-w-4xl sm:px-6 lg:px-8">

		<h1 class="text-xl text-center font-semibold text-indigo-500 mt-10 mb-10 title">Articles</h1>

		<?php if (count($articles) === 0): ?>

			<p class="text-center">No articles yet :(</p>

		<?php else: ?>

			<ul class="gap-x-6 shadow-md">
				<?php foreach ($articles as $key => $article) : ?>
					<li class="relative px-4 <?php echo ($key === count($articles) - 1) ? 'py-4' : 'pt-4'; ?> text-neutral-500">
						<?php $contributor = (new ArticleRepository)->getArticleAuthor($article->id); ?>
						<?php if ($key > 0): ?>
							<div class="h-px -mx-4 mb-4 bg-gray-200 border-0 dark:bg-gray-700"></div>
						<?php endif; ?>

						<a href="<?php echo $article->url; ?>" class="font-semibold text-indigo-500"><?php echo $article->title; ?></a>
						<div class="flex items-center">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-5 h-5 mr-2" role="img">
								<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
							</svg>
							Created at <?php echo date_format(new DateTimeImmutable($article->created_at), 'l jS \o\f F Y, g:i A'); ?>
						</div>
						<?php if ($article->updated_at): ?>
							<div class="flex items-center">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline-block w-5 h-5 mr-2" role="img">
									<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
								</svg>
								Updated at <?php echo date_format(new DateTimeImmutable($article->updated_at), 'l jS \o\f F Y, g:i A'); ?>
							</div>
						<?php endif; ?>

						<div class="mt-4">
							<img class="inline-block h-8 w-8 mr-2 rounded-full cover" src="<?php echo image($contributor->profile_picture); ?>" alt="" />
							Posted by
							<?php echo $contributor->name; ?>
						</div>

						<?php if (isset($authenticatedUser) && $authenticatedUser->id === $contributor->id): ?>

							<div class="flex absolute top-8 right-4">
								<a href="/articles/edit?id=<?php echo $article->id; ?>">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000" class="w-6 h-6" role="img" aria-label="Edit">
										<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
									</svg>
								</a>

								<a href="/articles/delete?id=<?php echo $article->id; ?>" class="ml-1">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#e00" class="w-6 h-6" role="img" aria-label="Delete">
										<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
									</svg>
								</a>
							</div>

						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>

		<?php endif; ?>
	</div>
</body>