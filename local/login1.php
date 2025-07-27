<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Selection</title>
   
</head>
<body>
    <div class="container">
        <a href="../admin/adminlogin.php" class="option admin">
            <div class="icon">👨‍💼</div>
            <h2>Admin Login</h2>
            <p>Access administrative functions</p>
        </a>
        <a href="../user/signup.php" class="option user">
            <div class="icon">👤</div>
            <h2>User Login</h2>
            <p>Access your user account</p>
        </a>
    </div>
</body>
</html>

<style>
        :root {
            --dark-bg: rgb(14, 1, 1);
            --admin-color: #2980b9;
            --admin-hover: #3498db;
            --user-color: #27ae60;
            --user-hover: #2ecc71;
            --text-light: #ffffff;
            --transition-speed: 0.3s;
            --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 10px 15px rgba(0, 0, 0, 0.2);
            --border-radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--dark-bg);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 20%);
            color: var(--text-light);
            line-height: 1.6;
        }

        .container {
            display: flex;
            width: 90%;
            max-width: 1000px;
            min-height: 500px;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: transform var(--transition-speed) ease;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        .option {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 2rem;
            text-decoration: none;
            transition: all var(--transition-speed) ease;
            position: relative;
            overflow: hidden;
        }

        .option::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
            z-index: 1;
        }

        .option:hover {
            flex: 1.1;
        }

        .option-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 90%;
        }

        .admin {
            background-color: var(--admin-color);
        }

        .admin:hover {
            background-color: var(--admin-hover);
        }

        .user {
            background-color: var(--user-color);
        }

        .user:hover {
            background-color: var(--user-hover);
        }

        h2 {
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .icon {
            font-size: 4.5rem;
            margin-bottom: 2rem;
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.3));
        }

        p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background-color: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
            backdrop-filter: blur(5px);
        }

        .option:hover .btn {
            background-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                min-height: auto;
            }
            
            .option {
                padding: 3rem 1rem;
            }
            
            .option:hover {
                flex: 1;
            }
        }
    </style>