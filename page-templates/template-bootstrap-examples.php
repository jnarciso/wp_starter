<?php
/**
 * Template Name: Bootstrap Examples
 */

get_header(); ?>

	<style type="text/css">
		.bs-grid-example div[class^="col-"] span {
			display: block;
			margin-bottom: 30px;
			color: #888;
			font-size: 15px;
			line-height: 40px;
			text-align: center;
			background-color: #ededed;
		}
	</style>

	<div class="main-content" role="main">

		<div class="container">
			<div class="row">
				<div class="main-content-inner col-xs-12">

				<h3>12-column Grid</h3>
					<div class="bs-grid-example">
						<div class="row">
							<div class="col-md-12"><span>col 12</span></div>
						</div>
						<div class="row">
							<div class="col-md-10"><span>col 10</span></div>
							<div class="col-md-2"><span>col 2</span></div>
						</div>
						<div class="row">
							<div class="col-md-8"><span>col 8</span></div>
							<div class="col-md-4"><span>col 4</span></div>
						</div>
						<div class="row">
							<div class="col-md-6"><span>col 6</span></div>
							<div class="col-md-6"><span>col 6</span></div>
						</div>
						<div class="row">
							<div class="col-md-3"><span>col 3</span></div>
							<div class="col-md-3"><span>col 3</span></div>
							<div class="col-md-3"><span>col 3</span></div>
							<div class="col-md-3"><span>col 3</span></div>
						</div>
						<div class="row">
							<div class="col-md-4"><span>col 4</span></div>
							<div class="col-md-4"><span>col 4</span></div>
							<div class="col-md-4"><span>col 4</span></div>
						</div>
						<div class="row">
							<div class="col-md-2"><span>col 2</span></div>
							<div class="col-md-2"><span>col 2</span></div>
							<div class="col-md-2"><span>col 2</span></div>
							<div class="col-md-2"><span>col 2</span></div>
							<div class="col-md-2"><span>col 2</span></div>
							<div class="col-md-2"><span>col 2</span></div>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>

<?php 
	get_footer();
