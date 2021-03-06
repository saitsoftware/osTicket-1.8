<?php
if(!defined('OSTCLIENTINC')) die('Access Denied!');
$info=array();
if($thisclient && $thisclient->isValid()) {
    $info=array('name'=>$thisclient->getName(),
                'email'=>$thisclient->getEmail(),
                'phone'=>$thisclient->getPhoneNumber());
}

$info=($_POST && $errors)?Format::htmlchars($_POST):$info;

$form = null;
if (!$info['topicId'])
    $info['topicId'] = $cfg->getDefaultTopicId();

if ($info['topicId'] && ($topic=Topic::lookup($info['topicId']))) {
    $form = $topic->getForm();
    if ($_POST && $form) {
        $form = $form->instanciate();
        $form->isValidForClient();
    }
}

?>
<h1><?php echo __('Open a New Ticket');?></h1>
<p><?php echo __('Please fill in the form below to open a new ticket.');?></p>
<form id="ticketForm" method="post" action="open.php" enctype="multipart/form-data">
  <?php csrf_token(); ?>
  <input type="hidden" name="a" value="open">
  <table width="800" cellpadding="1" cellspacing="0" border="0">
    <tbody>
    <tr>
        <td class="required"><?php echo __('Help Topic');?>:</td>
        <td>
            <select id="topicId" name="topicId" onchange="javascript:
                    var data = $(':input[name]', '#dynamic-form').serialize();
                    $.ajax(
                      'ajax.php/form/help-topic/' + this.value,
                      {
                        data: data,
                        dataType: 'json',
                        success: function(json) {
                          $('#dynamic-form').empty().append(json.html);
                          $(document.head).append(json.media);
                        }
                      });">
                <option value="" selected="selected">&mdash; <?php echo __('Select a Help Topic');?> &mdash;</option>
                <?php
                if($topics=Topic::getPublicHelpTopics()) {
                    foreach($topics as $id =>$name) {
                        echo sprintf('<option value="%d" %s>%s</option>',
                                $id, ($info['topicId']==$id)?'':'', $name);
                    }
                } else { ?>
                    <option value="0" ><?php echo __('General Inquiry');?></option>
                <?php
                } ?>
            </select>
            <font class="error">*&nbsp;<?php echo $errors['topicId']; ?></font>
        </td>
    </tr>
    
            <tr>
            <td class="required">
                <?php echo __('Producto');?>:
            </td>
            <td>
                <select name="producto" required="required">
                    <option value="" selected="selected">&mdash;<?php echo __('Seleccione Producto'); ?>&mdash;</option>
                    <option value="SAIT Basico" <?php echo ($info['producto']=='SAIT Basico')?'selected="selected"':''; ?>>SAIT B&aacute;sico</option>
                    <option value="SAIT ERP" <?php echo ($info['producto']=='SAIT ERP')?'selected="selected"':''; ?>>SAIT ERP</option>
                    <option value="SAIT Contabilidad" <?php echo ($info['producto']=='SAIT Contabilidad')?'selected="selected"':''; ?>>SAIT Contabilidad</option>
                    <option value="SAIT Nomina" <?php echo ($info['producto']=='SAIT Nomina')?'selected="selected"':''; ?>>SAIT N&oacute;mina</option>
                    <option value="SAIT Movil" <?php echo ($info['producto']=='SAIT Movil')?'selected="selected"':''; ?>>SAIT M&oacute;vil</option>
                    <option value="Boveda (OCF)" <?php echo ($info['producto']=='Boveda')?'selected="selected"':''; ?>>Boveda (OCF)</option>
                    <option value="F123" <?php echo ($info['producto']=='F123')?'selected="selected"':''; ?>>Factura 123</option>
                    <option value="Enlace" <?php echo ($info['producto']=='Enlace')?'selected="selected"':''; ?>>Enlace de Sucursales</option>
                </select>
                <font class="error">*&nbsp;<?php echo $errors['producto']; ?></font>
            </td>
        </tr>
    
<?php
        if (!$thisclient) {
            $uform = UserForm::getUserForm()->getForm($_POST);
            if ($_POST) $uform->isValid();
            $uform->render(false);
        }
        else { ?>
            <tr><td colspan="2"><hr /></td></tr>
        <tr><td><?php echo __('Email'); ?>:</td><td><?php echo $thisclient->getEmail(); ?></td></tr>
        <tr><td><?php echo __('Client'); ?>:</td><td><?php echo $thisclient->getName(); ?></td></tr>
        <?php } ?>
    </tbody>
    <tbody id="dynamic-form">
        <?php if ($form) {
            include(CLIENTINC_DIR . 'templates/dynamic-form.tmpl.php');
        } ?>
    </tbody>
    <tbody><?php
        $tform = TicketForm::getInstance()->getForm($_POST);
        if ($_POST) $tform->isValid();
        $tform->render(false); ?>
    </tbody>
    <tbody>
    <?php
    if($cfg && $cfg->isCaptchaEnabled() && (!$thisclient || !$thisclient->isValid())) {
        if($_POST && $errors && !$errors['captcha'])
            $errors['captcha']=__('Please re-enter the text again');
        ?>
    <tr class="captchaRow">
        <td class="required"><?php echo __('CAPTCHA Text');?>:</td>
        <td>
            <span class="captcha"><img src="captcha.php" border="0" align="left"></span>
            &nbsp;&nbsp;
            <input id="captcha" type="text" name="captcha" size="6" autocomplete="off">
            <em><?php echo __('Enter the text shown on the image.');?></em>
            <font class="error">*&nbsp;<?php echo $errors['captcha']; ?></font>
        </td>
    </tr>
    <?php
    } ?>
    <tr><td colspan=2>&nbsp;<b>Nota:</b>¿ Necesita  anexar algunos archivos ? </br>
    Para imágenes usar <a href="https://justpaste.it/" target="_blank">JustPaste.it</a></br>
    Cualquier otro tipo de archivos usar: <a href="http://ge.tt/" target="_blank">ge.tt/</a></br>
    En ambos casos, compartir URL generado en la descripción del problema.</td></tr>
    </tbody> 
  </table>
<hr/>
  <p style="text-align:center;">
        <input type="submit" value="<?php echo __('Create Ticket');?>">
        <input type="reset" name="reset" value="<?php echo __('Reset');?>">
        <input type="button" name="cancel" value="<?php echo __('Cancel'); ?>" onclick="javascript:
            $('.richtext').each(function() {
                var redactor = $(this).data('redactor');
                if (redactor && redactor.opts.draftDelete)
                    redactor.deleteDraft();
            });
            window.location.href='index.php';">
  </p>
</form>
