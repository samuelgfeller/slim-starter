<?php
/**
 * @var Slim\Interfaces\RouteParserInterface $route
 * @var Slim\Views\PhpRenderer $this Rendering engine
 * @var App\Domain\User\Data\UserData $user user
 */
$this->setLayout('layout/layout.html.php');
?>

<?php
// Define assets that should be included
// https://samuel-gfeller.ch/docs/Template-Rendering#asset-handling
$this->addAttribute('css', [
    'assets/general/page-component/form/form.css',
    'assets/general/page-component/modal/alert-modal.css',
    'assets/general/page-component/modal/form-modal.css',
    'assets/general/page-component/contenteditable/contenteditable.css',
    // page-specific css has to come last to overwrite other styles
    'assets/user/user.css',
]);

$this->addAttribute(
    'jsModules',
    ['assets/user/read/user-read-update-main.js']
);

?>
<!-- User id for javascript -->
<data id="user-id" value="<?php echo html((string)$user->id); ?>"></data>

<div id="user-page-content-flexbox">
    <div id="user-profile-content">
        <div id="outer-contenteditable-heading-container">
            <div class="inner-contenteditable-heading-div contenteditable-field-container" data-field-element="h1">
                <!-- Img has to be before title because only the next sibling can be styled in css -->
                <img src="assets/general/general-img/action/material-edit-icon.svg"
                     class="contenteditable-edit-icon cursor-pointer"
                     alt="Edit"
                     id="edit-first-name-btn">

                <h1 data-name="first_name" data-minlength="2" data-maxlength="100" data-required="true"
                    spellcheck="false"><?php echo !empty($user->firstName) ? html($user->firstName) : '&nbsp;'; ?></h1>
            </div>
            <div class="inner-contenteditable-heading-div contenteditable-field-container" data-field-element="h1">

                <img src="assets/general/general-img/action/material-edit-icon.svg"
                     class="contenteditable-edit-icon cursor-pointer"
                     alt="Edit"
                     id="edit-last-name-btn">

                <h1 data-name="last_name" data-minlength="2" data-maxlength="100" data-required="true"
                    spellcheck="false"><?php echo !empty($user->lastName) ? html($user->lastName) : '&nbsp;'; ?></h1>
            </div>
        </div>

        <h3 class="label-h3">E-Mail</h3>
        <div class="contenteditable-field-container user-field-value-container" data-field-element="span">

            <img src="assets/general/general-img/action/material-edit-icon.svg"
                 class="contenteditable-edit-icon cursor-pointer"
                 alt="Edit"
                 id="edit-email-btn">

            <span spellcheck="false" data-name="email" data-maxlength="254"
            ><?php echo !empty($user->email) ? html($user->email) : '&nbsp;'; ?></span>
        </div>
        <h3 class="label-h3">Metadata</h3>
        <p class="subdued-text"><b>ID:</b> <?php echo html((string)$user->id); ?><br>
            <b>Created:</b> <?php echo $user->createdAt?->format('H:i:s Y-m-d'); ?><br>
            <?php
            if ($user->updatedAt !== null) {
                ?>
                <b> Updated:</b> <?php echo $user->updatedAt->format('H:i:s Y-m-d'); ?>
                <?php
            } ?>
        </p>

        <button class="btn btn-red" id="delete-user-btn">
            <img class="icon-in-btn" src="assets/general/general-img/action/trash-icon.svg" alt="">Delete user
        </button>
    </div>
</div>