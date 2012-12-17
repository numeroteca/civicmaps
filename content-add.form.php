<?php
// errors code construction
//echo $action_slug;
if ( $form_errors[0] != '' ) {
	$form_error_code = "";
	foreach ( $form_errors as $form_error ) {
		$form_error_code .= "<div class='error'>" .$form_error. "</div>";
	}
}
$dropdowncategories = wp_dropdown_categories('taxonomy=resource-category' ); 

	$add_form = "<section class='page-text'>" .$form_error_code. "</section>
	<form id='addcontent' name='addcontent' method='post' class='part-mid1' action='" .$action_slug. "' enctype='multipart/form-data'>
		<fieldset class='required" .$form_tit_class. "'>
		<span class='req'>*</span>
			<label>Project name</label>
			<input id='addcontent-tit' name ='addcontent-tit' type='text' value='" .$form_tit. "' />
			<div class='mini-faq'>Introduce here the name of the project/research/initiative here in no more than 4 words.</div>
		</fieldset>
		<fieldset class='required" .$form_desc_class. "'>
		<span class='req'>*</span>
			<label>Description</label>
			<textarea id='addcontent-desc' name='addcontent-desc' cols='45' rows='10'>" .$form_desc. "</textarea>
			<div class='mini-faq'>
			Provide here a description of your project/research/initiative explaining the reasons why it is innovative 
			and how it contributes to expand and evolve architecture and urbanism. Text should be between 100 and 400 words. 
			Only English text will be admitted.
			The first words will appear in the <a target='_blank' href='/resources/'>Resource list</a>.</div>
		</fieldset>
		<fieldset class='required'>
			<label>Categories</label>
			<div class='project-categories'>
				" .$dropdowncategories. "
			</div>
			<div class='mini-faq'><strong>Choose a category!</strong> This field is not working yet</div>
		</fieldset>
		<fieldset>
			<label>Tags</label>
			<div class='project-tags'>
				<input id='addcontent-tag1' name='addcontent-tag1' type='text' value='" .$form_tags[1]. "' />
				<input id='addcontent-tag2' name='addcontent-tag2' type='text' value='" .$form_tags[2]. "' />
				<input id='addcontent-tag3' name='addcontent-tag3' type='text' value='" .$form_tags[3]. "' />
				<input id='addcontent-tag4' name='addcontent-tag4' type='text' value='" .$form_tags[4]. "' />
				<input id='addcontent-tag5' name='addcontent-tag5' type='text' value='" .$form_tags[5]. "' />
			</div>
			<div class='mini-faq faq-tags'><strong>Tag the resource!</strong> Helps other users to find it. You can choose 5 tags at the most.</div>
		</fieldset>
		<fieldset id='addcontent1' class='clonedField'>
			<label>Image</label>
	    		<input type='hidden' name='MAX_FILE_SIZE' value='2000000' />
			<input id='addcontent-file1' name='addcontent-file1' type='file' />
			<div class='mini-faq'>All images should have a 4:3 proportion ratio. Each image should have at least 1500x1125px. The file should not be bigger than 1mb. Images should be png, jpg or gif format
			</div>
		</fieldset>
		<fieldset class='moreless'>
			<input class='midbut' type='button' id='addcontent-btnAdd' value='+' />
			<input class='midbut' type='button' id='addcontent-btnDel' value='-' />
			<label>Want to upload more images?</label>
		</fieldset>
		<fieldset>
			<input id='addcontent-video' name='addcontent-video' type='text' value='" .$form_video. "' />
			<select id='addcontent-videoapi' name='addcontent-videoapi' value='" .$form_videoapi. "'>
				<option value=''></option>
				<option value='youtube'>Youtube</option>
				<option value='vimeo'>Vimeo</option>
			</select>
			<label>Video ID</label>
			<div class='mini-faq'><strong>To add a video to your project</strong> you have to choose beetwen Youtube and Vimeo, depending on where your video is hosted. Then you have to fill in the video ID in the left box.<br /><a href='http://productforums.google.com/forum/#!topic/youtube/r3zYlqEmTcc[1-25]' target='_blank'>How to know a Youtube video ID</a> | <a href='http://social.msdn.microsoft.com/Forums/pl-PL/csharpgeneral/thread/cf832a1b-95dc-4fa6-a0e4-658b21597648' target='_blank'>How to know a Vimeo video ID</a></div>
		</fieldset>
		<fieldset>
			<input id='addcontent-url' name='addcontent-url' type='text' value='http://' />
			<label>Project website</label>
		</fieldset>
		<fieldset>
			<input id='addcontent-submit' name='addcontent-submit' type='submit' value='Submit' />
		</fieldset>
	</form><!-- #addcontent -->
	";
?>
