<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OpenAI Test</title>
</head>
<body>
  <div class="p-6 max-w-md">
    <input id="nameInput" type="text" placeholder="名前を入力"
      class="border rounded p-2 w-full mb-4" />

    <button id="generateBtn"
      class="bg-blue-500 text-white px-4 py-2 rounded">
      生成する
    </button>

    <p id="result" class="mt-4 text-gray-700"></p>
  </div>

  <script>
  document.getElementById("generateBtn").addEventListener("click", async () => {
    const name = document.getElementById("nameInput").value;
    const resultElem = document.getElementById("result");

    resultElem.textContent = "生成中...";

    try {
        const res = await fetch("/openai", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ name }),
            });
        const data = await res.json(); // これ1回だけ！
        resultElem.textContent = data.choices
        ? data.choices[0].message.content
        : (data.result || data.error || "不明なエラー");

    } catch (err) {
    resultElem.textContent = "通信エラー: " + err;
  }
  });
  </script>
</body>
</html>
  