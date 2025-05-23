<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&display=swap" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8" />
  <title>PlanIt</title>

  <style>
  @import url('https://fonts.googleapis.com/css2?family=SF+Pro+Text:wght@400;600&display=swap');
  
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }
  html, body {
    height: 100%;
    font-family: 'SF Pro Text', sans-serif;
    background-color: #f9f9f9;
    color: #1d1d1f;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-size: 17px; /* Increased base font size */
  }

  header {
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 24px;
    border-bottom: 1px solid #d1d1d6;
    font-weight: 600;
    font-size: 1.3rem;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: saturate(180%) blur(20px);
    position: sticky;
    top: 0;
    z-index: 999;
  }

  header .logo {
    font-size: 1.6rem;
    font-weight: 700;
  }

  header nav.auth-nav {
    display: flex;
    align-items: center;
    gap: 12px;
  }
  header nav.auth-nav a,
  header nav.auth-nav button {
    color: #007aff;
    background: none;
    border: none;
    font-weight: 500;
    font-size: 1.1rem; /* slightly bigger */
    text-decoration: none;
    cursor: pointer;
    padding: 8px 14px; /* bigger padding */
    border-radius: 8px;
    transition: background 0.2s ease;
  }
  header nav.auth-nav a:hover,
  header nav.auth-nav button:hover {
    background-color: rgba(0, 122, 255, 0.1);
  }

  .container {
    display: flex;
    height: calc(100vh - 60px);
    overflow: hidden;
  }

  nav.sidebar {
    width: 240px;
    background: #f5f5f7;
    border-right: 1px solid #d1d1d6;
    display: flex;
    flex-direction: column;
    padding: 20px 0;
    gap: 10px;
  }
  nav.sidebar a {
    padding: 14px 22px; 
    font-size: 1.1rem; 
    font-weight: 500;
    text-decoration: none;
    color: #1d1d1f;
    border-radius: 12px;
    transition: background 0.2s ease;
  }
  nav.sidebar a:hover,
  nav.sidebar a.active {
    background: rgba(0, 122, 255, 0.1);
    color: #007aff;
  }

  main.content {
    flex-grow: 1;
    padding: 32px 40px;
    overflow-y: auto;
    background-color: #ffffff;
  }

  section {
    margin-bottom: 40px;
  }
  section h2 {
    font-size: 1.6rem; 
    font-weight: 600;
    margin-bottom: 20px;
  }

  input, select, button {
    font-family: inherit;
    font-size: 16px;
  }

  input, select {
    width: 100%;
    padding: 14px 20px; 
    margin-bottom: 20px; 
    border: 1.5px solid #c7c7cc;
    border-radius: 12px;
    background: #ffffff;
    transition: border 0.2s ease, box-shadow 0.2s ease;
  }
  input:focus, select:focus {
    outline: none;
    border-color: #007aff;
    box-shadow: 0 0 0 3px rgba(0, 122, 255, 0.25);
  }

  button {
    padding: 14px 28px; 
    border: none;
    border-radius: 14px;
    background-color: #007aff;
    color: white;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 122, 255, 0.3);
    transition: background-color 0.2s ease, box-shadow 0.2s ease;
    min-height: 44px; 
    min-width: 130px;
  }
  button:hover {
    background-color: #005ecb;
    box-shadow: 0 6px 16px rgba(0, 94, 203, 0.4);
  }
  button:active {
    background-color: #004a9f;
    box-shadow: none;
  }

  
  .actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 2rem; 
  }

  #task-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 24px;
    list-style: none;
    padding: 0;
    margin: 0;
  }
  #task-list li {
    background: #f5f5f7;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    transition: box-shadow 0.3s ease;
  }
  #task-list li:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
  }

  .task-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
  }
  .task-content {
    font-weight: 600;
    font-size: 1.15rem;
    color: #1d1d1f;
  }
  .task-due {
    font-size: 0.9rem;
    color: #6e6e73;
  }
  .task-description {
    font-size: 1rem;
    color: #3c3c4399;
    margin-bottom: 16px;
  }
  .task-actions {
    display: flex;
    justify-content: flex-end;
    gap: 14px;
  }
  .task-actions input[type="checkbox"] {
    width: 22px;
    height: 22px;
    cursor: pointer;
  }
  .task-actions button {
    background-color: #ff3b30;
    color: white;
    padding: 8px 18px;
    border-radius: 12px;
    font-size: 1rem;
  }
  .task-actions button:hover {
    background-color: #d32f2f;
  }

  pre {
    background: #f5f5f7;
    padding: 20px;
    border-radius: 12px;
    font-size: 1rem;
    color: #1d1d1f;
    overflow-x: auto;
    min-height: 200px; 
  }

  @media (max-width: 768px) {
    .container {
      flex-direction: column;
      height: auto;
    }
    nav.sidebar {
      flex-direction: row;
      overflow-x: auto;
      width: 100%;
      border-right: none;
      border-bottom: 1px solid #d1d1d6;
    }
    nav.sidebar a {
      padding: 12px 18px;
      white-space: nowrap;
    }
    main.content {
      padding: 28px 24px;
    }
  }
</style>

</head>

<body>

  <header><span class="logo">PlanIt</span>
    @if (Route::has('login'))
  <nav class="auth-nav">
    @auth
      <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
      </form>
    @else
      <a href="{{ route('login') }}">Login</a>
      @if (Route::has('register'))
        <a href="{{ route('register') }}">Register</a>
      @endif
    @endauth
  </nav>
@endif
  </header>

  <div class="container">

    <nav class="sidebar" role="navigation" aria-label="API Sections">
      <a href="#tasks" class="active" onclick="showSection('tasks')">Tasks</a>
      <a href="#todoist" onclick="showSection('todoist')">To do</a>
      <a href="#weather" onclick="showSection('weather')">Weather</a>
      <a href="#timezone" onclick="showSection('timezone')">Timezone</a>
      <a href="#holidays" onclick="showSection('holidays')">Holidays</a>
      <a href="#quote" onclick="showSection('quote')">Quote</a>
    </nav>

    <main class="content">
      <!-- Tasks Section: only saved tasks -->
      <section id="tasks-section">
        <h2>Your Tasks</h2>
        <ul id="task-list" aria-live="polite" aria-label="List of saved tasks"></ul>
      </section>

      <!-- Todoist Section: only the add task form -->
      <section id="todoist-section" style="display:none;">
        <h2>Add Task</h2>
        <input type="text" id="taskContent" placeholder="Task title" aria-label="Task title" />
        <input type="text" id="taskDescription" placeholder="Task description" aria-label="Task description" />
        <input type="date" id="taskDueDate" aria-label="Task due date" />
        <button onclick="addTask()">Add Task</button>
        <pre id="taskResult" aria-live="polite"></pre>
      </section>

      <!-- Weather Section -->
      <section id="weather-section" style="display:none;">
        <h2>Get Weather</h2>
        <input type="text" id="city" placeholder="City name" aria-label="City name" />
        <button onclick="getWeather()">Get Weather</button>
        <pre id="weatherResult" aria-live="polite"></pre>
      </section>

      <!-- Timezone Section -->
      <section id="timezone-section" style="display:none;">
        <h2>Get Timezone</h2>
        <input type="text" id="countryName" placeholder="Country name (e.g. Philippines)" aria-label="Country name" />
        <button onclick="getTimezone()">Get Timezone</button>
        <pre id="timezoneResult" aria-live="polite"></pre>
      </section>

      <!-- Holidays Section -->
      <section id="holidays-section" style="display:none;">
        <h2>Get Holidays</h2>
        <input type="text" id="country" placeholder="Country code (e.g. PH)" aria-label="Country code" />
        <input type="text" id="year" placeholder="Year (e.g. 2025)" aria-label="Year" />
        <select id="month" aria-label="Month">
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
        <button onclick="getHolidays()">Get Holidays</button>
        <pre id="holidaysResult" aria-live="polite"></pre>
      </section>

      <!-- Quote Section -->
      <section id="quote-section" style="display:none;">
        <h2>Get Quote</h2>
        <button onclick="getMotivationalQuote()">Get Quote</button>
        <pre id="motivationalQuoteResult"></pre>
      </section>
    </main>

  </div>

  <script>
    function showSection(section) {
      const sections = ['tasks', 'todoist', 'weather', 'timezone', 'holidays', 'quote'];
      sections.forEach(s => {
        document.getElementById(`${s}-section`).style.display = (s === section) ? 'block' : 'none';
      });

      document.querySelectorAll('nav.sidebar a').forEach(link => {
        link.classList.toggle('active', link.textContent.toLowerCase() === section);
      });
    }

    // Start with tasks visible
    showSection('tasks');

let tasks = [];

function renderTasks() {
  const list = document.getElementById('task-list');
  list.innerHTML = '';
  if (tasks.length === 0) {
    list.innerHTML = '<li>No saved tasks</li>';
    return;
  }
  tasks.forEach((task, idx) => {
    const li = document.createElement('li');
    li.setAttribute('tabindex', 0);

    const headerDiv = document.createElement('div');
    headerDiv.className = 'task-header';

    const contentSpan = document.createElement('span');
    contentSpan.className = 'task-content';
    contentSpan.textContent = task.content;

    headerDiv.appendChild(contentSpan);

    if (task.due_date) {
      const dueSpan = document.createElement('span');
      dueSpan.className = 'task-due';
      dueSpan.textContent = `Due: ${task.due_date}`;
      headerDiv.appendChild(dueSpan);
    }

    li.appendChild(headerDiv);

    if (task.description) {
      const descP = document.createElement('p');
      descP.className = 'task-description';
      descP.textContent = task.description;
      li.appendChild(descP);
    }

    const actionsDiv = document.createElement('div');
    actionsDiv.className = 'task-actions';

    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.checked = task.is_completed || false;
    checkbox.setAttribute('aria-label', `Mark task "${task.content}" completed`);
    checkbox.addEventListener('change', () => {
      fetch(`/tasks/${task.id}/toggle`, { method: 'PATCH' })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            task.is_completed = data.is_completed;
            renderTasks();
          } else {
            alert('Failed to update task status');
          }
        })
        .catch(() => alert('Error updating task status'));
    });

    const delBtn = document.createElement('button');
delBtn.textContent = 'Delete';
delBtn.setAttribute('aria-label', `Delete task "${task.content}"`);
delBtn.addEventListener('click', () => {
  fetch(`/api/tasks/${task.id}`, {
    method: 'DELETE',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  })
    .then(res => res.json())
    .then(data => {
      if (data.message) {
        tasks.splice(idx, 1);
        renderTasks();
      } else {
        alert('Failed to delete task');
      }
    })
    .catch(() => alert('Error deleting task'));
});
    actionsDiv.appendChild(checkbox);
    actionsDiv.appendChild(delBtn);

    li.appendChild(actionsDiv);

    list.appendChild(li);
  });
}

function loadTasks() {
  fetch('/tasks')
    .then(response => response.json())
    .then(data => {
      tasks = data;
      renderTasks();
    })
    .catch(error => console.error('Failed to load tasks:', error));
}

// Call loadTasks after DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  loadTasks();
});


    function addTask() {
  const content = document.getElementById('taskContent').value.trim();
  const description = document.getElementById('taskDescription').value.trim();
  const dueDate = document.getElementById('taskDueDate').value;

  if (!content) {
    alert('Task title is required');
    return;
  }

  // Send to Laravel backend
  fetch('/api/task', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    },
    body: JSON.stringify({
      content: content,
      description: description,
      due_date: dueDate,
    }),
  })
  .then(response => response.json())
  .then(data => {
    if (data.local_task) {
      tasks.push({
        content: data.local_task.content,
        description: data.local_task.description,
        due: data.local_task.due_date,
        completed: false,
      });
      renderTasks();
      showSection('tasks');

      // Confirmation message
      document.getElementById('taskResult').textContent =
        `Added task: ${content}${dueDate ? ' (Due ' + dueDate + ')' : ''}`;
    } else {
      alert('Failed to add task');
      console.error(data);
    }
  })
  .catch(error => {
    alert('An error occurred');
    console.error(error);
  });

  // Clear form
  document.getElementById('taskContent').value = '';
  document.getElementById('taskDescription').value = '';
  document.getElementById('taskDueDate').value = '';
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
        document.getElementById('weatherResult').innerText =
          `Weather in ${simplified.location}:\n` +
          `• Condition: ${simplified.weather}\n` +
          `• Temperature: ${simplified.temperature_c}\n` +
          `• Humidity: ${simplified.humidity}\n` +
          `• Wind Speed: ${simplified.wind_speed}`;
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
      if (data.error) {
        document.getElementById('timezoneResult').innerText = 'Error: ' + data.error;
        return;
      }

      document.getElementById('timezoneResult').innerText =
        `Country: ${data.country || 'N/A'}\n` +
        `City: ${data.city || 'N/A'}\n` +
        `Current Time: ${data.time || 'Unavailable'}`;
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

      const holidayList = data
  .map(h => {
    const date = h.date?.iso;
    const formatted = date
      ? new Date(date).toLocaleString('en-PH', {
          year: 'numeric',
          month: 'long',
          day: 'numeric',
          hour: 'numeric',
          minute: 'numeric',
          timeZoneName: 'short'
        })
      : 'Date unknown';

    return `• ${h.name} — ${formatted}`;
  })
  .join('\n');

      document.getElementById('holidaysResult').innerText = `Holidays:\n${holidayList}`;
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
 document.addEventListener('DOMContentLoaded', function () {
      fetch('/api/tasks')
        .then(response => response.json())
        .then(data => {
          tasks = data;
          renderTasks();
        })
        .catch(error => {
          console.error('Failed to load tasks:', error);
        });
    });

    window.addEventListener('DOMContentLoaded', () => {
  renderTasks();
});

  </script>

</body>
</html>
