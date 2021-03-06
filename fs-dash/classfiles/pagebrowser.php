<?php 

function pageBrowser(){
	
	?>
	
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-file fa-fw"></i> Pages</h3>
			</div>
			<div class="panel-body">
				<div class="list-group">
				
				<?php 
				
				$query = "select * from pages";
				$result = sqlquery($query);
				
				$fpidArrayContent = "";
				$pagenameArrayContent = "";
				$curPos = 0;
				
				$cachecontent = array();
				
				while($table_headings = mysql_fetch_assoc($result)){
				
				$pagelink = 'loadEditorialContent('.$curPos.')';
				$pagename = $table_headings["Pagename"];
				$cpageid = $table_headings["PageID"];
				
				$fpidArrayContent .= '"'.$table_headings["PageID"].'",';
				$pagenameArrayContent .= '"'.$table_headings["Pagename"].'",';
				
				?>
					<a href="#" onclick="<?php echo $pagelink; ?>" class="list-group-item">
						<i class="fa fa-fw fa-file-text"></i> <?php echo $pagename; ?>
						<span class="badge badge-danger" onclick="delPage('<?php echo $cpageid; ?>')"><i class="fa fa-trash-o"></i> Remove</span>
					</a>
					
				<?php 
				
				$curPos++;
				
				$tablerow = array("name" => $table_headings["PageID"], "content" => $table_headings["Content"]);
				array_push($cachecontent, $tablerow);
				
				}
				
				include("/../page_cache/compile-cache.php");
				$cc = new CacheCompiler();
				
				$cc->purge();
				$cc->cache($cachecontent);
				
				?>
					<div id="add_new_site_placeholder"></div>
					
					<a href="#" class="list-group-item" id="control_addpage" onclick="newpage('add_new_site_placeholder');">
						<i class="fa fa-fw fa-plus-circle"></i> Add Page
					</a>
					<form id="delPageForm" method="get"></form>
				</div>
			</div>
		</div>
	</div>
	
	<?php
	$fpidArrayContent = trim(preg_replace('/\s+/', ' ', $fpidArrayContent));
	$pagenameArrayContent = trim(preg_replace('/\s+/', ' ', $pagenameArrayContent));
	
	echo '<script>var fpidArray = ['.substr($fpidArrayContent, 0, strlen($fpidArrayContent)-1).'];</script>';
	echo '<script>var pagenameArray = ['.substr($pagenameArrayContent, 0, strlen($pagenameArrayContent)-1).'];</script>';
}
?>