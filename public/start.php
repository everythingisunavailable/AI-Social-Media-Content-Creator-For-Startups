<?php
// ai_selection.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your AI - Shair</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Segoe UI', sans-serif; display: flex; min-height: 100vh; flex-wrap: wrap; }
        .left, .right { flex: 1; min-width: 300px; padding: 40px; display: flex; flex-direction: column; justify-content: center; }
        .left { background: #e8eef5; }
        .right { background: #1f2933; color: #fff; text-align: center; }
        h2 { font-size: 24px; margin-bottom: 20px; }
        .ai-option { margin: 10px 0; padding: 15px; background: #fff; border: 1px solid #ddd; border-radius: 8px; display: flex; align-items: center; gap: 10px; cursor: pointer; transition: background 0.2s; }
        .ai-option:hover { background: #eef2f7; }
        .add-own { margin: 15px 0; padding: 15px; background: #e0e0e0; border-radius: 8px; cursor: pointer; }
        .company-name { font-size: 48px; font-weight: bold; }
        .company-name .gradient { background: linear-gradient(90deg, #3b82f6, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .statement { font-size: 18px; margin-top: 10px; color: #ccc; }
        button { margin-top: 20px; padding: 12px 20px; border: none; border-radius: 8px; cursor: pointer; background: #3b82f6; color: #fff; font-size: 16px; }
        a { text-decoration: none; color: inherit; }
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .company-name { font-size: 36px; }
        }
    </style>
</head>
<body>
    <div class="left">
        <h2>Choose Your AI</h2>
        <form action="index.php" method="get">
            <label class="ai-option"><input type="radio" name="ai" value="openai/gpt-oss-20b    ">Openai/gpt-oss-20b (free)</label>
            <label class="ai-option"><input type="radio" name="ai" value="mixtral"> Mixtral</label>
            <label class="ai-option"><input type="radio" name="ai" value="gemma"> Gemma</label>
            <label class="ai-option"><input type="radio" name="ai" value="llama2"> LLaMA 2</label>
            <div class="add-own"><input type="radio" name="ai" value="custom"> + Add Your Own</div>
            <button type="submit">Continue</button>
        </form>
    </div>
    <div class="right">
        <a href="index.php">
            <div class="company-name">Sh<span class="gradient">AI</span>r</div>
            <div class="statement">Empowering your content with seamless AI sharing</div>
        </a>
    </div>
</body>
</html>
