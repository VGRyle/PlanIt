<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PlanIt Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 2rem;
      background: #f3f3f3;
    }
    h2 {
      color: #333;
    }
    section {
      background: white;
      padding: 1rem;
      margin-bottom: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    input, button {
      margin: 0.5rem 0;
      padding: 0.5rem;
    }
    pre {
      background: #eee;
      padding: 1rem;
      overflow-x: auto;
    }
  </style>
</head>
<body>

  <h1>PlanIt API Tester</h1>

  <!-- Add Task -->
  <section>
    <h2>Add Task (Todoist)</h2>
    <input type="text" id="taskContent" placeholder="Task content">
    <br>
    <button onclick="addTask()">Add Task</button>
    <pre id="taskResult"></pre>
  </section>

  <!-- Get Weather -->
  <section>
    <h2>Get Weather</h2>
    <input type="text" id="city" placeholder="City name">
    <br>
    <button onclick="getWeather()">Get Weather</button>
    <pre id="weatherResult"></pre>
  </section>

  <!-- Get Timezone -->
  <section>
    <h2>Get Timezone</h2>
    <input type="text" id="lat" placeholder="Latitude" value="14.5995">
    <input type="text" id="lng" placeholder="Longitude" value="120.9842">
    <br>
    <button onclick="getTimezone()">Get Timezone</button>
    <pre id="timezoneResult"></pre>
  </section>

  <!-- Get Holidays -->
  <section>
    <h2>Get Holidays</h2>
    <input type="text" id="country" placeholder="Country code (e.g. PH)">
    <input type="text" id="year" placeholder="Year (e.g. 2025)">
    <br>
    <button onclick="getHolidays()">Get Holidays</button>
    <pre id="holidaysResult"></pre>
  </section>

  <!-- Get Quotes -->
  <section>
    <h2>Quote of the Day</h2>
    <button onclick="getMotivationalQuote()">Get Quote</button>
    <pre id="motivationalQuoteResult"></pre>
  </section>

  <!-- Compile Plan -->
  <section>
    <h2>New Task</h2>
    <input type="text" id="planContent" placeholder="Task content">
    <input type="text" id="planCity" placeholder="City">
    <input type="text" id="planLat" placeholder="Latitude">
    <input type="text" id="planLng" placeholder="Longitude">
    <input type="text" id="planCountry" placeholder="Country code (e.g. PH)">
    <input type="text" id="planYear" placeholder="Year (e.g. 2025)">
    <br>
    <button onclick="compilePlan()">Create</button>
    <pre id="planResult"></pre>
  </section>

  <script>
    function addTask() {
      const content = document.getElementById('taskContent').value;
      fetch('/api/task', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ content })
      })
      .then(res => res.json())
      .then(data => document.getElementById('taskResult').innerText = JSON.stringify(data, null, 2))
      .catch(err => document.getElementById('taskResult').innerText = 'Error: ' + err.message);
    }

    function getWeather() {
      const city = document.getElementById('city').value;
      fetch(`/api/weather/${encodeURIComponent(city)}`)
      .then(res => res.json())
      .then(data => document.getElementById('weatherResult').innerText = JSON.stringify(data, null, 2))
      .catch(err => document.getElementById('weatherResult').innerText = 'Error: ' + err.message);
    }

    function getTimezone() {
      const lat = document.getElementById('lat').value;
      const lng = document.getElementById('lng').value;
      fetch(`/api/timezone?lat=${encodeURIComponent(lat)}&lng=${encodeURIComponent(lng)}`)
      .then(res => res.json())
      .then(data => document.getElementById('timezoneResult').innerText = JSON.stringify(data, null, 2))
      .catch(err => document.getElementById('timezoneResult').innerText = 'Error: ' + err.message);
    }

    function getHolidays() {
      const country = document.getElementById('country').value;
      const year = document.getElementById('year').value;
      fetch(`/api/holidays/${encodeURIComponent(country)}/${encodeURIComponent(year)}`)
      .then(res => res.json())
      .then(data => document.getElementById('holidaysResult').innerText = JSON.stringify(data, null, 2))
      .catch(err => document.getElementById('holidaysResult').innerText = 'Error: ' + err.message);
    }

    function getMotivationalQuote() {
      fetch('/api/quote/motivation')
        .then(res => res.json())
        .then(data => {
          if (data && data.body && data.author) {
            document.getElementById('motivationalQuoteResult').innerText = `"${data.body}"\n— ${data.author}`;
          } else {
            document.getElementById('motivationalQuoteResult').innerText = 'No quote received.';
          }
        })
        .catch(err => {
          document.getElementById('motivationalQuoteResult').innerText = 'Error: ' + err.message;
        });
    }

    function compilePlan() {
      const payload = {
        content: document.getElementById('planContent').value,
        city: document.getElementById('planCity').value,
        lat: document.getElementById('planLat').value,
        lng: document.getElementById('planLng').value,
        country: document.getElementById('planCountry').value,
        year: document.getElementById('planYear').value
      };

      fetch('/api/planit/compile', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      })
      .then(res => res.json())
      .then(data => document.getElementById('planResult').innerText = JSON.stringify(data, null, 2))
      .catch(err => document.getElementById('planResult').innerText = 'Error: ' + err.message);
    }
  </script>

</body>
</html>
