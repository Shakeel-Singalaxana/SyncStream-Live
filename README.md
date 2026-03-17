# SyncStream Live: Collaborative Broadcast Workflow

SyncStream is a real-time web-based control suite designed for live broadcast overlays (vMix/OBS). It features a unique dual-role architecture that allows event **Organizers** to push live data while keeping **Operators** informed through an automated notification system.

## 🚀 Key Enhancements

### 1. Immediate Scoreboard Updates
Bypass the traditional "Draft-to-Promote" workflow. Organizers can now push updates directly to the live overlay using the **Update LIVE Scoreboard** action, significantly reducing latency during fast-paced events.

### 2. Smart Operator Notifications (The Blinker)
To maintain situational awareness, the Operator Dashboard features a **Scoreboard Live Indicator**:
* **Visual Alert:** Blinks yellow when the Organizer pushes a direct update.
* **Auto-Acknowledge:** The alert automatically clears after 30 seconds if not manually dismissed, ensuring the dashboard stays clean.

### 3. Integrated Graphic Automation
* **Direct Pushes:** Organizers can now trigger Marks and Schedule updates directly to the overlay.
* **Auto-Hide Timers:** Set custom "Time-on-Screen" durations (in seconds) so graphics fade out automatically without manual intervention.

### 4. Modern Production UI
* **Unified Dark Theme:** Reduced glare for operators working in dark production environments.
* **vMix/OBS Ready:** Transparent backgrounds configured out-of-the-box for seamless chroma/alpha integration.

## 🛠 Feature Comparison

| Feature | Previous Workflow | New Enhanced Workflow |
| :--- | :--- | :--- |
| **Data Sync** | Save Draft → Promote | **Update LIVE** (Immediate) |
| **Coordination** | Manual Syncing | **Blinker Notification** (Auto-sync) |
| **Cleanup** | Manual Hide | **Auto-hide Timers** |
| **Interface** | Light Theme | **Pro Dark UI** |

## 📂 File Structure
* `scoreboard_organizer.html`: The command center for event staff to push scores and marks.
* `operator_dashboard.html`: The technical hub for monitoring live status and managing queues.
* `overlay.html`: The transparent broadcast-ready view for OBS/vMix.

## 🚦 Getting Started

## 🌐 Live Access & Security

The project is currently deployed and available for testing via the link below. Access to the administrative and organizer panels is restricted to prevent unauthorized live updates.

* **Live URL:** [shakbrotech.infinityfreeapp.com](https://shakbrotech.infinityfreeapp.com/)
* **Access Credentials:** * **Password:** `bcmu2025` (Required for Admin/Organizer panels)

> **Note:** This hosting is provided via a free tier service for demonstration purposes. High-traffic scenarios or long-term availability may vary.
