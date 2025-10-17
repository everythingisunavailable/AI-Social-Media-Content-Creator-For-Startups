<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        /* Widget and table styling */
        .widget-card {
            background:#fff;
            color:#333;
            border-radius:12px;
            padding:1.5rem;
            box-shadow:0 5px 15px rgba(0,0,0,0.15);
            max-width:600px;
            margin:2rem auto;
        }
        .widget-card select, .widget-card button {
            width:100%;
            padding:0.7rem;
            margin-bottom:1rem;
            border-radius:8px;
            border:1px solid #ccc;
            font-size:1rem;
        }
        .widget-card button {
            background:#2575fc;
            color:#fff;
            border:none;
            cursor:pointer;
            transition:0.3s;
        }
        .widget-card button:hover {
            background:#6a11cb;
        }
        .token-box {
            background:#f0f0f0;
            color:#333;
            padding:1rem;
            border-radius:8px;
            word-break:break-word;
            margin-bottom:1rem;
        }
        table {
            width:90%;
            max-width:600px;
            margin:2rem auto;
            border-collapse: collapse;
            background:#fff;
            border-radius:8px;
            overflow:hidden;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
        }
        table th, table td {
            padding:0.8rem;
            text-align:left;
            border-bottom:1px solid #ddd;
        }
        table th {
            background:#2575fc;
            color:#fff;
        }
        table tr:last-child td {
            border-bottom:none;
        }
    </style>
</head>
<body>
    <nav class="nav">
        <div class="nav-wrap">
            <div class="nav-left">
                <h1 class="logo">sh<span class="logo gradient">AI</span>r</h1>
            </div>
            <div class="nav-right">
                <div class="links">
                    <a href="./index.php" class="link active">Home</a>
                    <a href="./index.php" class="link">Dashboard</a>
                    <a href="./data.html" class="link active">Analytics</a>
                    <a href="./api.php" class="link">Connect to the API</a>
                </div>
                <div class="avatar" id="avatar">
                    <img src="https://api.dicebear.com/9.x/bottts/svg?seed=sii" alt="avatar">
                </div>
            </div>
        </div>
    </nav>

    <!-- API Key Widget -->
    <div class="widget-card">
        <select id="widgetKeyType">
            <option value="read_only">Read Only</option>
            <option value="read_write">Read & Write</option>
            <option value="admin">Admin</option>
        </select>
        <button id="widgetGenerateBtn">Generate API Key</button>

        <div id="widgetResult" style="display:none;">
            <div class="token-box" id="widgetToken"></div>
        </div>
    </div>

    <!-- Table for prior connections / generated keys -->
    <table id="connectionsTable">
        <thead>
            <tr>
                <th>#</th>
                <th>API Key</th>
                <th>Type</th>
                <th>Generated At</th>
            </tr>
        </thead>
        <tbody>
            <!-- Filled dynamically -->
        </tbody>
    </table>

    <script>
        // Demo token generator
        function generateDemoApiKey(keyType) {
            const randomPart = Math.random().toString(36).substr(2,8);
            const timestampPart = Date.now().toString(36);
            return `${keyType}-${randomPart}-${timestampPart}`;
        }

        // Keep an array of prior generated keys
        const generatedKeys = [];

        document.getElementById('widgetGenerateBtn').addEventListener('click', function() {
            const keyType = document.getElementById('widgetKeyType').value;
            const token = generateDemoApiKey(keyType);

            // Display in widget
            const resultBox = document.getElementById('widgetResult');
            const tokenBox = document.getElementById('widgetToken');
            tokenBox.textContent = token;
            resultBox.style.display = 'block';

            // Save to prior connections array
            const now = new Date().toLocaleString();
            generatedKeys.push({token, type:keyType, time:now});
            updateConnectionsTable();
        });

        function updateConnectionsTable() {
            const tbody = document.querySelector('#connectionsTable tbody');
            tbody.innerHTML = '';
            generatedKeys.forEach((entry, idx) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${idx+1}</td>
                    <td>${entry.token}</td>
                    <td>${entry.type}</td>
                    <td>${entry.time}</td>
                `;
                tbody.appendChild(tr);
            });
        }
    </script>
</body>
</html>
