<!DOCTYPE html>
<html>
<head>
    <title>Test Berita Create Access</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .test-container {
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background: #0056b3;
        }
        .debug {
            background: #f8f9fa;
            padding: 10px;
            border: 1px solid #ddd;
            margin: 10px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>Test Berita Create Access</h1>
        
        <div class="debug">
            <h3>Route Information:</h3>
            <p><strong>Create URL:</strong> {{ route('berita.create') }}</p>
            <p><strong>Index URL:</strong> {{ route('berita.index') }}</p>
            <p><strong>Current URL:</strong> {{ url()->current() }}</p>
            <p><strong>App URL:</strong> {{ config('app.url') }}</p>
        </div>
        
        <h3>Test Buttons:</h3>
        
        <!-- Test 1: Standard Link -->
        <a href="{{ route('berita.create') }}" class="btn">Test 1: Standard Link</a>
        
        <!-- Test 2: JavaScript Navigation -->
        <button class="btn" onclick="window.location.href='{{ route('berita.create') }}'">Test 2: JS Navigation</button>
        
        <!-- Test 3: Form Submit -->
        <form action="{{ route('berita.create') }}" method="GET" style="display: inline;">
            <button type="submit" class="btn">Test 3: Form Submit</button>
        </form>
        
        <!-- Test 4: Window Open -->
        <button class="btn" onclick="window.open('{{ route('berita.create') }}', '_self')">Test 4: Window Open</button>
        
        <div class="debug">
            <h3>JavaScript Tests:</h3>
            <button class="btn" onclick="runTests()">Run JavaScript Tests</button>
            <div id="test-results"></div>
        </div>
    </div>
    
    <script>
        function runTests() {
            const results = document.getElementById('test-results');
            results.innerHTML = '<h4>Test Results:</h4>';
            
            // Test 1: Check if route is accessible
            const createUrl = '{{ route("berita.create") }}';
            results.innerHTML += '<p>Create URL: ' + createUrl + '</p>';
            
            // Test 2: Try fetch
            fetch(createUrl, {
                method: 'HEAD',
                credentials: 'same-origin'
            })
            .then(response => {
                results.innerHTML += '<p>HEAD request status: ' + response.status + '</p>';
                results.innerHTML += '<p>HEAD request ok: ' + response.ok + '</p>';
            })
            .catch(error => {
                results.innerHTML += '<p>HEAD request error: ' + error.message + '</p>';
            });
            
            // Test 3: Check CSRF
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            results.innerHTML += '<p>CSRF Token available: ' + (csrfToken ? 'Yes' : 'No') + '</p>';
            
            // Test 4: Check session
            results.innerHTML += '<p>Session storage available: ' + (sessionStorage ? 'Yes' : 'No') + '</p>';
            results.innerHTML += '<p>Local storage available: ' + (localStorage ? 'Yes' : 'No') + '</p>';
        }
        
        // Auto run on load
        window.addEventListener('load', function() {
            setTimeout(runTests, 1000);
        });
    </script>
</body>
</html>
