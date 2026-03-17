// assets/js/overlay-client.js

class OverlayClient {
    constructor(endpoint, onUpdate) {
        this.endpoint = endpoint;
        this.onUpdate = onUpdate;
        this.lastUpdated = 0;
        this.pollingInterval = 1000;
    }

    start() {
        this.poll();
        setInterval(() => this.poll(), this.pollingInterval);
    }

    async poll() {
        try {
            const response = await fetch(this.endpoint + '?t=' + Date.now()); // Prevent caching
            if (!response.ok) return;

            const data = await response.json();
            
            // Check if data is new
            if (data.last_updated && data.last_updated > this.lastUpdated) {
                this.lastUpdated = data.last_updated;
                console.log("New data received", data);
                if (this.onUpdate) this.onUpdate(data);
            }
        } catch (error) {
            console.error("Polling error:", error);
        }
    }
}
