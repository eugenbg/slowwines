<?php
/**
 * Page Template
 *
 * Template Name:  Demo Components Bootstrap
 *
 * @file           demo-bootstrap.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2013 Two Impulse
 * @license        license.txt
 * @version        Release: 1.0
 */

get_header(); ?>

<div class="container">

		<header class="entry-header">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->


<h2 class="margin-top-50">Navbar</h2>

			<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Brand</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Link</a></li>
      <li><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li><a href="#">Separated link</a></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li>
    </ul>
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>

<!--NAVBAR===INVERSE==================================-->
<nav class="navbar navbar-inverse" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Brand</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Link</a></li>
      <li><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li><a href="#">Separated link</a></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li>
    </ul>
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>


<!--NAVS=====================================-->
<h2>Navs</h2>
<div class="row">
	<div class="col-lg-6">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Messages</a></li>
        </ul>
        <br />
        <ul class="nav nav-pills">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Messages</a></li>
		</ul>
        <br />
        <ul class="nav nav-pills">
          <li><a href="#">Link</a></li>
          <li><a href="#">Link</a></li>
          <li class="disabled"><a href="#">Disabled link</a></li>
		</ul>
	</div>
    <div class="col-lg-6">
    	<ul class="nav nav-pills nav-stacked">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Messages</a></li>
		</ul>
        <br />
        <ul class="nav nav-pills nav-justified">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Messages</a></li>
		</ul>
    </div>

</div>
<!--BREADCRUMBS=====================================-->
<h2>Breadcrumbs</h2>
<div class="row">
	<ul class="breadcrumb">
		<li class="active">Home</li>
	</ul>
	<ul class="breadcrumb">
        <li>
        <a href="#">Home</a>
        </li>
		<li class="active">Library</li>
	</ul>
	<ul class="breadcrumb" style="margin-bottom: 5px;">
        <li>
        <a href="#">Home</a>
        </li>
        <li>
        <a href="#">Library</a>
        </li>
		<li class="active">Data</li>
	</ul>
</div>

<!--BUTTONS=====================================-->
<h2 class="margin-top-50">Buttons</h2>
<div class="row">
    <div class="col-lg-5">
        <button class="btn btn-default" type="button">Default</button>
        <button class="btn btn-primary" type="button">Primary</button>
        <button class="btn btn-success" type="button">Success</button>
        <button class="btn btn-info" type="button">Info</button>
        <button class="btn btn-warning" type="button">Warning</button>
        <button class="btn btn-danger" type="button">Danger</button>
        <button class="btn btn-link" type="button">Link</button>
        <br> <br>
        <button class="btn btn-default disabled" type="button">Default</button>
        <button class="btn btn-primary disabled" type="button">Primary</button>
        <button class="btn btn-success disabled" type="button">Success</button>
        <button class="btn btn-info disabled" type="button">Info</button>
        <button class="btn btn-warning disabled" type="button">Warning</button>
        <button class="btn btn-danger disabled" type="button">Danger</button>
        <button class="btn btn-link disabled" type="button">Link</button>
    </div>
<div class="col-lg-7">
	<div class="btn-toolbar">
        <div class="btn-group">
            <button class="btn btn-default" type="button">Default</button>
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            <li>
            <a href="#">Action</a>
            </li>
            <li>
            <a href="#">Another action</a>
            </li>
            <li>
            <a href="#">Something else here</a>
            </li>
            <li class="divider"></li>
            <li>
            <a href="#">Separated link</a>
            </li>
            </ul>
        </div>
        <div class="btn-group">
        	<button class="btn btn-primary" type="button">Primary</button>
            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" type="button">
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            <li>
            <a href="#">Action</a>
            </li>
            <li>
            <a href="#">Another action</a>
            </li>
            <li>
            <a href="#">Something else here</a>
            </li>
            <li class="divider"></li>
            <li>
            <a href="#">Separated link</a>
            </li>
            </ul>
       </div>
        <div class="btn-group">
        	<button class="btn btn-success" type="button">Success</button>
            <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            <li>
            <a href="#">Action</a>
            </li>
            <li>
            <a href="#">Another action</a>
            </li>
            <li>
            <a href="#">Something else here</a>
            </li>
            <li class="divider"></li>
            <li>
            <a href="#">Separated link</a>
            </li>
            </ul>
       </div>
        <div class="btn-group">
        	<button class="btn btn-info" type="button">Info</button>
            <button class="btn btn-info dropdown-toggle" data-toggle="dropdown" type="button">
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            <li>
            <a href="#">Action</a>
            </li>
            <li>
            <a href="#">Another action</a>
            </li>
            <li>
            <a href="#">Something else here</a>
            </li>
            <li class="divider"></li>
            <li>
            <a href="#">Separated link</a>
            </li>
            </ul>
       </div>
        <div class="btn-group">
        	<button class="btn btn-warning" type="button">Warning</button>
            <button class="btn btn-warning dropdown-toggle" data-toggle="dropdown" type="button">
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            <li>
            <a href="#">Action</a>
            </li>
            <li>
            <a href="#">Another action</a>
            </li>
            <li>
            <a href="#">Something else here</a>
            </li>
            <li class="divider"></li>
            <li>
            <a href="#">Separated link</a>
            </li>
            </ul>
       </div>
        <div class="btn-group">
        	<button class="btn btn-danger" type="button">Danger</button>
            <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown" type="button">
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            <li>
            <a href="#">Action</a>
            </li>
            <li>
            <a href="#">Another action</a>
            </li>
            <li>
            <a href="#">Something else here</a>
            </li>
            <li class="divider"></li>
            <li>
            <a href="#">Separated link</a>
            </li>
            </ul>
       </div>
        <div class="btn-group">
        	<button class="btn btn-link" type="button">Link</button>
            <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" type="button">
            <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            <li>
            <a href="#">Action</a>
            </li>
            <li>
            <a href="#">Another action</a>
            </li>
            <li>
            <a href="#">Something else here</a>
            </li>
            <li class="divider"></li>
            <li>
            <a href="#">Separated link</a>
            </li>
            </ul>
       </div>
	</div><!--button toolbar-->
			<div style="margin-top:10px;">
            <button class="btn btn-primary btn-lg" type="button">Large button</button>
            <button class="btn btn-primary" type="button">Default button</button>
            <button class="btn btn-primary btn-sm" type="button">Small button</button>
            <button class="btn btn-primary btn-xs" type="button">Mini button</button>
            </div>

	</div><!--col-lg-7-->
</div><!--row-->
<!--FORMS=====================================-->
<h1 class="margin-top-50">Forms</h1>
<div class="row">
	<div class="col-lg-6">
    <div class="form-group">
        <label class="control-label" for="focusedInput">Focused input</label>
        <input id="focusedInput" class="form-control" type="text" value="This is focused...">
    </div>
    <div class="form-group">
        <label class="control-label" for="disabledInput">Disabled input</label>
        <input id="disabledInput" class="form-control" type="text" disabled="" placeholder="Disabled input here...">
    </div>
    <div class="form-group has-warning">
        <label class="control-label" for="inputWarning">Input warning</label>
        <input id="inputWarning" class="form-control" type="text">
    </div>
    <div class="form-group has-error">
        <label class="control-label" for="inputError">Input error</label>
        <input id="inputError" class="form-control" type="text">
    </div>
    <div class="form-group has-success">
        <label class="control-label" for="inputSuccess">Input success</label>
        <input id="inputSuccess" class="form-control" type="text">
    </div>
    <div class="form-group">
        <label class="control-label" for="inputLarge">Large input</label>
        <input id="inputLarge" class="form-control input-lg" type="text">
    </div>
    <div class="form-group">
        <label class="control-label" for="inputDefault">Default input</label>
        <input id="inputDefault" class="form-control" type="text">
    </div>
    <div class="form-group">
        <label class="control-label" for="inputSmall">Small input</label>
        <input id="inputSmall" class="form-control input-sm" type="text">
    </div>
    <div class="form-group">
    	<label class="control-label">Input addons</label>
    <div class="input-group">
        <span class="input-group-addon">$</span>
        <input class="form-control" type="text">
        <span class="input-group-btn">
        <button class="btn btn-default" type="button">Button</button>
        </span>
    </div>
    </div>
    </form>
    </div>

    <div class="col-lg-6">
        <div class="well">
			<form class="bs-example form-horizontal">
            <fieldset>
            <legend>Legend</legend>
            <div class="form-group">
            <label class="col-lg-2 control-label" for="inputEmail">Email</label>
            <div class="col-lg-10">
            <input id="inputEmail" class="form-control" type="text" placeholder="Email">
            </div>
			</div>

            <div class="form-group">
            <label class="col-lg-2 control-label" for="inputPassword">Password</label>
            <div class="col-lg-10">
            <input id="inputPassword" class="form-control" type="password" placeholder="Password">
            <div class="checkbox">
            <label>
            <input type="checkbox">
            Checkbox
            </label>
            </div>
            </div>
            </div>

            <div class="form-group">
            <label class="col-lg-2 control-label" for="textArea">Textarea</label>
            <div class="col-lg-10">
            <textarea id="textArea" class="form-control" rows="3"></textarea>
            <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
            </div>
            </div>

            <div class="form-group">
            <label class="col-lg-2 control-label">Radios</label>
            <div class="col-lg-10">
            <div class="radio">
            <label>
            <input id="optionsRadios1" type="radio" checked="" value="option1" name="optionsRadios">
            Option one is this
            </label>
            </div>
            <div class="radio">
            <label>
            <input id="optionsRadios2" type="radio" value="option2" name="optionsRadios">
            Option two can be something else
            </label>
            </div>
            </div>
            </div>

            <div class="form-group">
            <label class="col-lg-2 control-label" for="select">Selects</label>
            <div class="col-lg-10">
            <select id="select" class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            </select>
            <br>
            <select class="form-control" multiple="">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            </select>
            </div>
            </div>

            <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
            <button class="btn btn-default">Cancel</button>
            <button class="btn btn-primary" type="submit">Submit</button>
            </div>
            </div>
            </fieldset>
            </form>
            </div>
   </div>

</div><!--row-->

<!--TYPOGRAPHY=====================================-->
<h2 class="margin-top-50">Typography</h2>
<div class="row">
    <div class="col-lg-4">
        <h1>Heading 1</h1>
        <h2>Heading 2</h2>
        <h3>Heading 3</h3>
        <h4>Heading 4</h4>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>
    </div>
    <div class="col-lg-4">
    <h2>Example body text</h2>
        <p>
        Nullam quis risus eget
        <a href="#">urna mollis ornare</a>
        vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.
        </p>
        <p>
        <small>This line of text is meant to be treated as fine print.</small>
        </p>
        <p>
        The following snippet of text is
        <strong>rendered as bold text</strong>
        .
        </p>
        <p>
        The following snippet of text is
        <em>rendered as italicized text</em>
        .
        </p>
        <p>
        An abbreviation of the word attribute is
        <abbr title="attribute">attr</abbr>
        .
        </p>
    </div>
    <div class="col-lg-4">
    	<h2>Emphasis classes</h2>
            <p class="text-muted">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</p>
            <p class="text-primary">Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p class="text-warning">Etiam porta sem malesuada magna mollis euismod.</p>
            <p class="text-danger">Donec ullamcorper nulla non metus auctor fringilla.</p>
            <p class="text-success">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
            <p class="text-info">Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
    </div>
</div>

<!--TABLES=====================================-->
<h2 class="margin-top-50">Tables</h2>
<div class="row">
    <div class="col-lg-12">
    	<table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
            <th>#</th>
            <th>Column heading</th>
            <th>Column heading</th>
            <th>Column heading</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td>1</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
            </tr>
            <tr>
            <td>2</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
            </tr>
            <tr>
            <td>3</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
            </tr>
            <tr class="success">
            <td>4</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
            </tr>
            <tr class="danger">
            <td>5</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
            </tr>
            <tr class="warning">
            <td>6</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
            </tr>
            <tr class="active">
            <td>7</td>
            <td>Column content</td>
            <td>Column content</td>
            <td>Column content</td>
            </tr>
       </tbody>
     </table>
    </div>
</div>

<!--PAGINATION=====================================-->
<h2 class="margin-top-50">Pagination</h2>
	<div class="row">
    	<div class="col-lg-6">
        	<ul class="pagination">
              <li><a href="#">&laquo;</a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">&raquo;</a></li>
			</ul>
            <br />
            <ul class="pagination">
              <li class="disabled"><a href="#">&laquo;</a></li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">&raquo;</a></li>
			</ul>
            <ul class="pager">
              <li><a href="#">Previous</a></li>
              <li><a href="#">Next</a></li>
            </ul>

		</div>
        <div class="col-lg-6">
        <ul class="pagination pagination-lg">
              <li><a href="#">&laquo;</a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">&raquo;</a></li>
			</ul>
            <br />
            <ul class="pagination">
              <li><a href="#">&laquo;</a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">&raquo;</a></li>
			</ul>
            <br />
            <ul class="pagination pagination-sm">
              <li><a href="#">&laquo;</a></li>
              <li><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">&raquo;</a></li>
			</ul>
        </div>
    </div>

<!--LABELS=====================================-->

	<div class="row">
    	<div class="col-lg-6">
        <h2 class="margin-top-50">Labels</h2>
            <h1>
            Example heading
            <span class="label label-default">New</span>
            </h1>
            <h2>
            Example heading
            <span class="label label-default">New</span>
            </h2>
            <h3>
            Example heading
            <span class="label label-default">New</span>
            </h3>
            <h4>
            Example heading
            <span class="label label-default">New</span>
            </h4>
            <h5>
            Example heading
            <span class="label label-default">New</span>
            </h5>
            <h6>
            Example heading
            <span class="label label-default">New</span>
            </h6>
            <br />
            <span class="label label-default">Default</span>
            <span class="label label-primary">Primary</span>
            <span class="label label-success">Success</span>
            <span class="label label-info">Info</span>
            <span class="label label-warning">Warning</span>
            <span class="label label-danger">Danger</span>
        </div>
        <div class="col-lg-6">
        <h2 class="margin-top-50">Badges</h2>
        <ul class="nav nav-pills">
            <li class="active">
                <a href="#">
                Home
                <span class="badge">42</span>
                </a>
            </li>
            <li>
            	<a href="#">Profile</a>
            </li>
            <li>
                <a href="#">
                Messages
                <span class="badge">3</span>
                </a>
            </li>
            </ul>
            <br>
            <ul class="nav nav-pills nav-stacked" style="max-width: 260px;">
            <li class="active">
                <a href="#">
                <span class="badge pull-right">42</span>
                Home
                </a>
            </li>
            <li>
            	<a href="#">Profile</a>
            </li>
            <li>
                <a href="#">
                <span class="badge pull-right">3</span>
                Messages
                </a>
            </li>
            </ul>
        </div>
</div>

<!--JUMBOTRON=====================================-->
<h2 class="margin-top-50">Jumbotron</h2>
	<div class="row">
    	<div class="jumbotron">
            <div class="container">
            <h1>Hello, world!</h1>
            <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <p>
            <a class="btn btn-primary btn-lg">Learn more</a>
            </p>
            </div>
        </div>
    </div>

<!--ALERTS=====================================-->
<h2 class="margin-top-50">Alerts</h2>
	<div class="row">
    	<div class="alert alert-success">
            <strong>Well done!</strong>
            You successfully read this important alert message.
            </div>
            <div class="alert alert-info">
            <strong>Heads up!</strong>
            This alert needs your attention, but it's not super important.
            </div>
            <div class="alert alert-warning">
            <strong>Warning!</strong>
            Best check yo self, you're not looking too good.
            </div>
            <div class="alert alert-danger">
            <strong>Oh snap!</strong>
            Change a few things up and try submitting again.
		</div>
<h4 class="margin-top-50">Alerts with links</h4>
        <div class="alert alert-success">
            <strong>Well done!</strong>
            You successfully read this <a href="#" class="alert-link">important alert message.</a>
            </div>
            <div class="alert alert-info">
            <strong>Heads up!</strong>
            This <a href="#" class="alert-link">alert needs your attention,</a> but it's not super important.
            </div>
            <div class="alert alert-warning">
            <strong>Warning!</strong>
            Best check yo self, you're <a href="#" class="alert-link">not looking too good.</a>
            </div>
            <div class="alert alert-danger">
            <strong>Oh snap!</strong>
            <a href="#" class="alert-link">Change a few things</a> up and try submitting again.
		</div>
    </div>

<!--PROGRESS BARS=====================================-->
<h2 class="margin-top-50">Progress Bars</h2>
	<div class="row">
    	<div class="col-lg-3">
        	<div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                    <span class="sr-only">40% Complete (success)</span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                    <span class="sr-only">20% Complete</span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    <span class="sr-only">60% Complete (warning)</span>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="sr-only">80% Complete</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
        	<div class="progress progress-striped">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                    <span class="sr-only">40% Complete (success)</span>
                  </div>
                </div>
                <div class="progress progress-striped">
                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                    <span class="sr-only">20% Complete</span>
                  </div>
                </div>
                <div class="progress progress-striped">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    <span class="sr-only">60% Complete (warning)</span>
                  </div>
                </div>
                <div class="progress progress-striped">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="sr-only">80% Complete (danger)</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
        	<div class="progress progress-striped active">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                    <span class="sr-only">40% Complete (success)</span>
                  </div>
                </div>
                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                    <span class="sr-only">20% Complete</span>
                  </div>
                </div>
                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                    <span class="sr-only">60% Complete (warning)</span>
                  </div>
                </div>
                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                    <span class="sr-only">80% Complete (danger)</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
        	<div class="progress">
              <div class="progress-bar progress-bar-success" style="width: 35%">
                <span class="sr-only">35% Complete (success)</span>
              </div>
              <div class="progress-bar progress-bar-warning" style="width: 20%">
                <span class="sr-only">20% Complete (warning)</span>
              </div>
              <div class="progress-bar progress-bar-danger" style="width: 10%">
                <span class="sr-only">10% Complete (danger)</span>
              </div>
            </div>
        </div>
    </div>


<!--LIST GROUP=====================================-->
<h2 class="margin-top-50">List Group</h2>
	<div class="row">
    	<div class="col-lg-3">
        	<ul class="list-group">
              <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li>
			</ul>
        </div>
        <div class="col-lg-3">
        	<ul class="list-group">
              <li class="list-group-item"><span class="badge">14</span>Cras justo odio</li>
              <li class="list-group-item"><span class="badge">5</span>Dapibus ac facilisis in</li>
              <li class="list-group-item"><span class="badge">3</span>Morbi leo risus</li>
              <li class="list-group-item"><span class="badge">44</span>Porta ac consectetur ac</li>
              <li class="list-group-item"><span class="badge">36</span>Vestibulum at eros</li>
			</ul>
        </div>
        <div class="col-lg-3">
        	<ul class="list-group">
              <li class="list-group-item active">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li>
			</ul>
        </div>
        <div class="col-lg-3">
        	<div class="list-group">
                <a class="list-group-item active" href="#">
                <h4 class="list-group-item-heading">List group item heading</h4>
                <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                </a>
                <a class="list-group-item" href="#">
                <h4 class="list-group-item-heading">List group item heading</h4>
                <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                </a>
            </div>
        </div>
	</div>


    
    
</div><!-- /.container -->

<?php get_footer(); ?>