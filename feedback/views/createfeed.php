<script language="javascript">
	$(function(){
		// select all desired input fields and attach tooltips to them
		$(".content  form.createorder :input").tooltip({

			// place tooltip on the right edge
			position: "center right",

			// a little tweaking of the position
			offset: [-2, 10],

			// use the built-in fadeIn/fadeOut effect
			effect: "fade",

			// custom opacity setting
			opacity: 0.7

		});

	})
</script>
<div class="feedback">
	<?php if(!empty($msg)): ?>
		<div class="message success"></div>
	<?php endif; ?>
	
	<?= validation_errors(); ?>
	<form class="createfeed" method="post" action="<?= site_url("feedback/createfeed"); ?>" >
		<table>
			<tr>
				<td>
					<fieldset>
						<legend> <?= lang("feedback.sender_label"); ?> </legend>
						<div>
							<div class="form_row">
								<label for="f_name"> <?= lang("feedback.f_name"); ?> <span> * </span> </label> 
								<input title="<?= lang("feedback.f_name"); ?>" type="text" name="f_name" value="<?= !empty($user)?$user->last_name.' '.$user->first_name:set_value("nsp_customer"); ?>" placeholder="<?= lang("feedback.nsp_customer");?>" required />
							</div>
							<div class="form_row">
								<label for="f_email"> <?= lang("feedback.f_email"); ?> <span> * </span> </label> 
								<input type="email" title="<?= lang("feedback.f_email"); ?>" name="f_email" value="<?= !empty($user)?$user->email:set_value("f_email"); ?>" placeholder="<?= lang("feedback.f_email"); ?>" />
							</div>
							<div class="form_row">
								<label for="f_phone"> <?= lang("feedback.f_phone"); ?> <span> * </span>  </label> 
								<input type="text" title="<?= lang("feedback.f_phone"); ?>" name="f_phone" value="<?= !empty($user)?$user->mobile:set_value("f_phone");?>" placeholder="<?= lang("feedback.email_customer"); ?>"/>
							</div>
								<label for="f_message"> <?= lang("feedback.f_message"); ?> </label>
								<textarea title="<?= lang("feedback.f_message"); ?>" name="f_message"><?= set_value("f_message"); ?></textarea>
							</div>
						</div>
					</fieldset>
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="Отправить" />
				</td>
			</tr>
		</table>
	<form>
</div>