<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>🌿 PlanIt Dashboard</title>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

  body {
    font-family: 'Poppins', sans-serif;
    background-color: #121212;
    color: #e0e0e0;
    padding: 2rem;
    margin: 0;
  }

  h1 {
    text-align: left;
    font-weight: 600;
    font-size: 2.8rem;
    color: #00d676;
    margin-bottom: 2rem;
  }

  h2 {
    font-weight: 600;
    font-size: 1.5rem;
    color: #00d676;
    border-bottom: 2px solid #00d676;
    padding-bottom: 0.4rem;
    margin-bottom: 1rem;
  }

  section {
    background-color: #1e1e1e;
    border-radius: 12px;
    padding: 1.8rem 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 8px 16px rgba(0, 214, 118, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  section:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0, 214, 118, 0.4);
  }

  input {
    width: 100%;
    padding: 12px 15px;
    margin: 0.5rem 0 1rem 0;
    background-color: #121212;
    border: 2px solid #333;
    border-radius: 8px;
    color: #eee;
    font-size: 1rem;
    transition: border-color 0.3s ease;
  }
  input::placeholder {
    color: #666;
  }
  input:focus {
    outline: none;
    border-color: #00d676;
    box-shadow: 0 0 8px #00d676;
    background-color: #181818;
  }

  button {
    background-color: #00d676;
    border: none;
    color: #121212;
    font-weight: 600;
    padding: 12px 25px;
    cursor: pointer;
    border-radius: 8px;
    font-size: 1rem;
    transition: background-color 0.25s ease, box-shadow 0.25s ease;
    box-shadow: 0 4px 8px rgba(0, 214, 118, 0.4);
  }
  button:hover {
    background-color: #00b858;
    box-shadow: 0 6px 14px rgba(0, 184, 88, 0.6);
  }
  button:active {
    background-color: #009f4f;
    box-shadow: none;
  }
  select {
  width: 100%;
  padding: 12px 15px;
  margin: 0.5rem 0 1rem 0;
  background-color: #121212;
  border: 2px solid #333;
  border-radius: 8px;
  color: #eee;
  font-size: 1rem;
  transition: border-color 0.3s ease;
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg width='12' height='8' viewBox='0 0 12 8' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.41.59L6 5.17l4.59-4.58L12 2l-6 6-6-6z' fill='%23eee'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.75rem center;
  background-size: 1rem;
}

select:focus {
  outline: none;
  border-color: #00d676;
  box-shadow: 0 0 8px #00d676;
  background-color: #181818;
}

  pre {
    background-color: #2c2c2c;
    padding: 1rem;
    border-radius: 8px;
    font-size: 0.95rem;
    overflow-x: auto;
    white-space: pre-wrap;
    word-wrap: break-word;
    color: #c8ffc8;
    user-select: text;
    margin-top: 1rem;
  }

  @media (max-width: 600px) {
    body {
      padding: 1rem;
    }
    section {
      padding: 1rem 1.2rem;
    }
    button, input {
      font-size: 0.9rem;
      padding: 10px 15px;
    }
  }
</style>

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
    <input type="text" id="countryName" placeholder="Country name (e.g. Philippines)">
    <br>
    <button onclick="getTimezone()">Get Timezone</button>
    <pre id="timezoneResult"></pre>
  </section>

  <section>
  <h2>Get Holidays</h2>
  <input type="text" id="country" placeholder="Country code (e.g. PH)">
  <input type="text" id="year" placeholder="Year (e.g. 2025)">
  <select id="month">
    <option value="">Select Month</option>
    <option value="1">January</option>
    <option value="2">February</option>
    <option value="3">March</option>
    <option value="4">April</option>
    <option value="5">May</option>
    <option value="6">June</option>
    <option value="7">July</option>
    <option value="8">August</option>
    <option value="9">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
  </select>
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
  .then(data => {
    const simplified = {
      content: data.content || '',
      description: data.description || '',
      created_at: data.created_at || '',
      deadline: data.due?.date || 'None'
    };
    document.getElementById('taskResult').innerText = JSON.stringify(simplified, null, 2);
  })
  .catch(err => {
    document.getElementById('taskResult').innerText = 'Error: ' + err.message;
  });
}

function getWeather() {
  const city = document.getElementById('city').value;
  fetch(`/api/weather/${encodeURIComponent(city)}`)
    .then(res => res.json())
    .then(data => {
      if (data && !data.error) {
        // Extract important details
        const kelvinToCelsius = k => (k - 273.15).toFixed(1);

        const simplified = {
          location: data.name,
          weather: data.weather[0].description,
          temperature_c: kelvinToCelsius(data.main.temp) + ' °C',
          humidity: data.main.humidity + '%',
          wind_speed: data.wind.speed + ' m/s',
        };

        // Show simplified details as formatted JSON
        document.getElementById('weatherResult').innerText = JSON.stringify(simplified, null, 2);
      } else {
        document.getElementById('weatherResult').innerText = 'No weather data found.';
      }
    })
    .catch(err => {
      document.getElementById('weatherResult').innerText = 'Error: ' + err.message;
    });
}

    function getTimezone() {
const country = document.getElementById('countryName').value;

  fetch(`/api/timezone?country=${encodeURIComponent(country)}`)
    .then(res => res.json())
    .then(data => {
      document.getElementById('timezoneResult').innerText = JSON.stringify(data, null, 2);
    })
    .catch(err => {
      document.getElementById('timezoneResult').innerText = 'Error: ' + err.message;
    });
}


function getHolidays() {
  const country = document.getElementById('country').value;
  const year = document.getElementById('year').value;
  const month = document.getElementById('month').value;

  fetch(`/api/holidays/${encodeURIComponent(country)}/${encodeURIComponent(year)}?month=${month}`)
    .then(res => res.json())
    .then(data => {
      if (!Array.isArray(data) || data.length === 0) {
        document.getElementById('holidaysResult').innerText = 'No holidays found for this month.';
        return;
      }

      const simplified = data.map(holiday => ({
        name: holiday.name,
        date: holiday.date?.iso
      }));

      document.getElementById('holidaysResult').innerText = JSON.stringify(simplified, null, 2);
    })
    .catch(err => {
      document.getElementById('holidaysResult').innerText = 'Error: ' + err.message;
    });
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
