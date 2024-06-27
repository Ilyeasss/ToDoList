<?php

require_once 'app/init.php';

$query = $pdo->prepare("
SELECT id, name, done, important
FROM items
WHERE user = :user
");

$query -> execute([
  'user' => $_SESSION['user_id']
]);

if ($query->rowCount()) {
  $items = $query;
} else {
  $items = [];
}

$t = date("H");

$queryUser = $pdo->prepare("
  SELECT * FROM users
  WHERE id = :id
");

$queryUser -> execute([
  'id' => $_SESSION['user_id']
]);

if ($queryUser->rowCount()) {
  $users = $queryUser;
}else{
  $users = [];
};


if(!isset($_SESSION['user_id'])){
  header('Location: login.php');
};
foreach($users as $user):
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To do list</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <div class="profile-container">
      <div class="avatar-container">
        <svg width="79" height="79" viewBox="0 0 79 79" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_48_48)">
        <rect width="79" height="79" rx="39.5" fill="url(#paint0_linear_48_48)"/>
        <path d="M47.6631 45.8201V48.9801C47.6631 53.1934 53.7198 55.0368 53.7198 55.0368C53.7198 55.0368 46.7414 60.3034 39.4998 60.3034C32.2581 60.3034 25.2798 55.0368 25.2798 55.0368C25.2798 55.0368 31.3841 53.1934 31.3365 48.9801C31.2888 44.7668 31.3207 42.2914 31.2888 35.0729C27.5147 30.181 27.757 26.8977 29.8207 24.5888C36.7348 16.8534 55.5631 19.4868 55.5631 19.4868C55.5631 19.4868 57.3201 38.4449 53.3248 43.9768C51.6131 46.3468 47.6631 45.8201 47.6631 45.8201Z" fill="url(#paint1_linear_48_48)"/>
        <path d="M47.6634 45.8202C41.8701 45.1618 38.4468 42.6602 38.4468 42.6602C40.6081 45.8577 43.9019 48.1163 47.6634 48.9802V45.8202Z" fill="#DB6F3D"/>
        <path d="M67.1499 63.0178C69.6568 68.1151 71.0999 79.8711 71.0999 79.8711H7.8999C7.8999 79.8711 9.3435 68.1138 11.8499 63.0178C14.3563 57.9218 28.9929 53.1952 28.9929 53.1952C31.814 58.9867 47.2967 58.9867 49.9993 53.1934C49.9993 53.1934 64.643 57.9205 67.1499 63.0178Z" fill="url(#paint2_linear_48_48)"/>
        <mask id="mask0_48_48" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="7" y="53" width="65" height="27">
        <path d="M67.1499 63.0178C69.6568 68.1151 71.0999 79.8711 71.0999 79.8711H7.8999C7.8999 79.8711 9.3435 68.1138 11.8499 63.0178C14.3563 57.9218 28.9929 53.1952 28.9929 53.1952C31.814 58.9867 47.2967 58.9867 49.9993 53.1934C49.9993 53.1934 64.643 57.9205 67.1499 63.0178Z" fill="url(#paint3_linear_48_48)"/>
        </mask>
        <g mask="url(#mask0_48_48)">
        <path d="M5.2666 75.84V73.7333H73.7333V75.84H5.2666ZM5.2666 70.5733V68.4666H73.7333V70.5733H5.2666ZM5.2666 65.3066V63.2H73.7333V65.3066H5.2666Z" fill="#012646"/>
        </g>
        <path d="M34.5374 27.1784C33.7 26.4593 32.6825 25.975 31.2441 26.7224C27.8342 28.4927 30.4149 35.2867 33.4432 35.2867C34.2332 35.2867 34.6261 37.7679 31.1088 39.5001C31.1088 36.7351 26.8954 29.8884 26.5268 23.6548C22.2871 22.0761 23.3404 15.7595 26.2511 15.7595C25.7866 9.96935 35.0588 6.97842 38.6491 10.3014C42.3004 5.92508 51.5171 8.16341 52.0735 11.9602C58.4112 8.57711 62.5771 18.3017 56.6429 22.0769C54.201 23.6306 48.4888 24.2217 40.243 24.2217C38.9982 24.2217 38.3009 24.5309 38.6491 26.0701C39.3229 29.0526 37.7585 30.9312 34.5374 27.1784Z" fill="url(#paint4_linear_48_48)"/>
        </g>
        <defs>
        <linearGradient id="paint0_linear_48_48" x1="39.5" y1="0" x2="39.5" y2="79" gradientUnits="userSpaceOnUse">
        <stop offset="0.143333" stop-color="#64EBBD"/>
        <stop offset="1" stop-color="white"/>
        </linearGradient>
        <linearGradient id="paint1_linear_48_48" x1="40.6138" y1="19.0547" x2="40.6138" y2="60.3034" gradientUnits="userSpaceOnUse">
        <stop stop-color="#E6864E"/>
        <stop offset="1" stop-color="#EB965E"/>
        </linearGradient>
        <linearGradient id="paint2_linear_48_48" x1="39.4999" y1="79.8711" x2="39.4999" y2="53.1934" gradientUnits="userSpaceOnUse">
        <stop stop-color="#0ED3CF"/>
        <stop offset="0.0001" stop-color="#BCD3CF"/>
        </linearGradient>
        <linearGradient id="paint3_linear_48_48" x1="39.4999" y1="79.8711" x2="39.4999" y2="53.1934" gradientUnits="userSpaceOnUse">
        <stop stop-color="#FFC9B3"/>
        <stop offset="1" stop-color="#FFD2C2"/>
        </linearGradient>
        <linearGradient id="paint4_linear_48_48" x1="41.6022" y1="7.89941" x2="41.6022" y2="39.5001" gradientUnits="userSpaceOnUse">
        <stop stop-color="#1D0024"/>
        <stop offset="1" stop-color="#100014"/>
        </linearGradient>
        <clipPath id="clip0_48_48">
        <rect width="79" height="79" rx="39.5" fill="white"/>
        </clipPath>
        </defs>
        </svg>
      </div>
      <div class="avatar-text-container">
        <p class="welcome"><?= $t<12 ? 'Good Morning' :'Good Afternoon,';?></p>
        <p class="username"><?= $user['username'] ?></p>
      <?php endforeach; ?>
      </div>
    </div>
    <div class="signout-button-container"><a href="signout.php" class="signout-button">Sign Out</a></div>
  </header>
  <section class="input-form-container">
    <form class="item-add" action="add.php" method="post">
      <input class="item-add-input" type="text" name="name" placeholder="Type a new item here." autocomplete="off" required>
      <input class="item-add-button" type="submit" value="Add" class="submit">
    </form>
  </section>
  <div class="list">
    <?php if(!empty($items)): ?>
    <ul class="items">
      <?php foreach($items as $item): ?>
      <li class="item-container">
        <?php if($item['done'] == 1): ?>
          <div class="item-mark-container"><div class="done-item-mark"></div></div><span class="item<?= $item['done'] ? ' done' : '';?>"><?php echo $item['name']; ?></span>
          <menu class="done-item-edit-menu"><a class="not-done-button" href="mark.php?as=notdone&item=<?= $item['id']; ?>">Undo</a><a href="delete.php?as=delete&item=<?= $item['id']; ?>" class="delete-icon"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#363639"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg></a></menu>
        <?php else: ?>
          <div class="item-mark-container"><div class="item-mark"></div></div><span class="item<?= $item['done'] ? ' done' : '';?>"><?php echo $item['name']; ?></span>
          <menu class="undone-item-edit-menu"><a class="done-button" href="mark.php?as=done&item=<?= $item['id']; ?>">Mark as Done</a><a href="delete.php?as=delete&item=<?= $item['id']; ?>" class="delete-icon"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#363639"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg></a></menu>
        <?php endif; ?>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php else: ?>
      <p class="no-item-message">No items added.</p>
    <?php endif; ?>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
  const checkboxes = document.querySelectorAll('.important-check');

  checkboxes.forEach((checkbox, index) => {
    const checked = localStorage.getItem(checkbox.id) === "true";
    checkbox.checked = checked;

    checkbox.addEventListener("change", function() {
        localStorage.setItem(checkbox.id, this.checked);

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "important.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("checkboxId=" + this.id + "&checked=" + this.checked);
    });

    const itemContainer = checkbox.closest('.item-container');
    if (checkbox.checked) {
      itemContainer.classList.add('is-important');
    }
    checkbox.addEventListener('change', function() {
      if (this.checked) {
        itemContainer.classList.add('is-important');
      } else {
        itemContainer.classList.remove('is-important');
      }
    });
  });
});

  </script>
</body>
</html>