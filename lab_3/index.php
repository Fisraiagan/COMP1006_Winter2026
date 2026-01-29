<?php require "includes/header.php" ?>
<main>
  <h2> Bake It Till U Make It!! 🧁</h2>
  <form action="info.php" method="post">

    <!-- Customer Information -->
    <fieldset>
      <legend>Customer Information</legend>
        <label for="first_name">First name</label>
        <input type="text" id="first_name" name="first_name" required>
        <label for="last_name">Last name</label>
        <input type="text" id="last_name" name="last_name" required>
        <label for="email">Address</label>
        <input type="email" id="email" name="email" required>
        <p>
        <label for="message">Additional notes</label><br>
        <textarea id="message" name="message" rows="4"
          placeholder="custom messages..."></textarea>
      </p>
      <p>
      <button type="submit">Place Order</button>
    </p>
    </fieldset>
    </body>
    </form>
