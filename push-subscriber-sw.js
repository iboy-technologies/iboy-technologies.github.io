self.addEventListener('push', function (e) {
  var d = {};
  try { d = e.data ? e.data.json() : {}; } catch (_e) {}
  var opts = {
    body: d.body || '',
    icon: d.icon || '',
    image: d.image || '',
    badge: d.badge || '',
    data: { url: d.url || '/' }
  };
  e.waitUntil(self.registration.showNotification(d.title || '', opts));
});
self.addEventListener('notificationclick', function (e) {
  e.notification.close();
  var url = (e.notification.data && e.notification.data.url) || '/';
  e.waitUntil(clients.openWindow(url));
});
