echo "Hello world";
<?php
<!-- ./public/index.html -->
<!DOCTYPE html>
<html>
  <head>
    <title>BotChat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <main>
      <table>
        <tr>
          <th><img src="cat.gif" alt="Keyboard Warrior"></th>
          <th>
            <section class="chat">
            </section>

            <form>
              <input type="text" placeholder="Send a message!" />
              <button>Send</button>
            </form>
          </th>
        </tr>
      </table>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://unpkg.com/socket.io-client@2/dist/socket.io.slim.js"></script>
    <script src="https://unpkg.com/cookie_js@1.2.2/cookie.min.js"></script>
    <script src="chat.js"></script>
  </body>
</html>

?>
