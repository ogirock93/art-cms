<ul class="art-ul">
	<li class="art-have-child"><span class="art-text-tag"><i class="fa fa-file-text-o" aria-hidden="true"></i><?php echo $pages; ?></span>
		<ul class="art-sub-menu">
			<?php
				$obIterator = new FilesystemIterator("../");
				$rxIterator = new RegexIterator($obIterator,'/\.(php|html)$/');
				$arFileList = array();
				foreach($rxIterator as $obFile):?>
				<li class="art-text-tag"><a href="admin/index.php?page=<?php echo $arFileList[] = $obFile->getFilename();?>" class="art-text-tag"><?php echo $arFileList[] = $obFile->getFilename(); ?></a></li>
				<?php endforeach;?>
		</ul>
	</li><?php if(count($files1 = glob( 'modules' . '/*', GLOB_ONLYDIR ))>0){ ?>
		<?php $dev=$_GET['dev_mode'];
		if (!$dev){ ?>
	<li class=" art-module-menu-wrap"  onclick="window.location.href='admin/modules.php'"><span class="art-text-tag"><i class="fa fa-plug" aria-hidden="true"></i><?php echo $modules; ?></span>
		
	</li>
		<?php } }?>
	<li class="art-text-tag" onclick="window.location.href='admin/settings.php'"><span class="art-text-tag"><i class="fa fa-cog" aria-hidden="true"></i><?php echo $settings; ?></span></li>
</ul>