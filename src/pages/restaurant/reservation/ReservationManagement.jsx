import { useState } from "react";

export default function ReservationManagement() {
  // ✅ DUMMY DATA
  const [reservations, setReservations] = useState([
    {
      id: 1,
      name: "Rahul Shetty",
      phone: "9876543210",
      date: "2026-04-12",
      time: "19:30",
      people: 4,
      status: "Booked"
    },
    {
      id: 2,
      name: "Ananya Rao",
      phone: "9123456780",
      date: "2026-04-12",
      time: "20:00",
      people: 2,
      status: "Completed"
    },
    {
      id: 3,
      name: "John D",
      phone: "9998887776",
      date: "2026-04-13",
      time: "21:00",
      people: 6,
      status: "Booked"
    }
  ]);

  const [showForm, setShowForm] = useState(false);

  const [newRes, setNewRes] = useState({
    name: "",
    phone: "",
    date: "",
    time: "",
    people: 1,
    status: "Booked"
  });

  // ➕ ADD
  const addReservation = () => {
    if (!newRes.name || !newRes.phone) return;

    setReservations([
      { ...newRes, id: Date.now() },
      ...reservations
    ]);

    setNewRes({
      name: "",
      phone: "",
      date: "",
      time: "",
      people: 1,
      status: "Booked"
    });

    setShowForm(false);
  };

  // 🔁 STATUS UPDATE
  const updateStatus = (id, status) => {
    setReservations(prev =>
      prev.map(r => (r.id === id ? { ...r, status } : r))
    );
  };

  const getBadge = (status) => {
    switch (status) {
      case "Booked":
        return "bg-warning text-dark";
      case "Completed":
        return "bg-success";
      case "Cancelled":
        return "bg-danger";
      default:
        return "bg-secondary";
    }
  };

  // 📊 STATS
  const total = reservations.length;
  const booked = reservations.filter(r => r.status === "Booked").length;
  const completed = reservations.filter(r => r.status === "Completed").length;
  const cancelled = reservations.filter(r => r.status === "Cancelled").length;

  return (
    <div className="container-fluid p-4">

      {/* HEADER */}
      <div className="d-flex justify-content-between align-items-center mb-3">
        <h3>🍽 Reservation Management</h3>

        <button
          className="btn btn-dark"
          onClick={() => setShowForm(!showForm)}
        >
          + New Reservation
        </button>
      </div>

      {/* FORM */}
      {showForm && (
        <div className="card shadow p-3 mb-3">
          <div className="row g-2">

            <div className="col-md-3">
              <input className="form-control" placeholder="Customer Name"
                value={newRes.name}
                onChange={(e) => setNewRes({ ...newRes, name: e.target.value })}
              />
            </div>

            <div className="col-md-2">
              <input className="form-control" placeholder="Phone"
                value={newRes.phone}
                onChange={(e) => setNewRes({ ...newRes, phone: e.target.value })}
              />
            </div>

            <div className="col-md-2">
              <input type="date" className="form-control"
                value={newRes.date}
                onChange={(e) => setNewRes({ ...newRes, date: e.target.value })}
              />
            </div>

            <div className="col-md-2">
              <input type="time" className="form-control"
                value={newRes.time}
                onChange={(e) => setNewRes({ ...newRes, time: e.target.value })}
              />
            </div>

            <div className="col-md-1">
              <input type="number" className="form-control"
                value={newRes.people}
                onChange={(e) => setNewRes({ ...newRes, people: e.target.value })}
              />
            </div>

            <div className="col-md-2">
              <button className="btn btn-success w-100" onClick={addReservation}>
                Save
              </button>
            </div>

          </div>
        </div>
      )}

      <div className="row">

        {/* LEFT TABLE */}
        <div className="col-md-8">

          <div className="card shadow">
            <div className="card-header bg-danger text-white">
              Reservations List
            </div>

            <table className="table table-hover mb-0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>People</th>
                  <th>Status</th>
                  <th>Update</th>
                </tr>
              </thead>

              <tbody>
                {reservations.map(r => (
                  <tr key={r.id}>
                    <td>{r.name}</td>
                    <td>{r.phone}</td>
                    <td>{r.date}</td>
                    <td>{r.time}</td>
                    <td>{r.people}</td>

                    <td>
                      <span className={`badge ${getBadge(r.status)}`}>
                        {r.status}
                      </span>
                    </td>

                    <td>
                      <select
                        className="form-select"
                        value={r.status}
                        onChange={(e) => updateStatus(r.id, e.target.value)}
                      >
                        <option>Booked</option>
                        <option>Completed</option>
                        <option>Cancelled</option>
                      </select>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>

        </div>

        {/* RIGHT PANEL */}
        <div className="col-md-4">

          {/* LIVE SUMMARY */}
          <div className="card shadow p-3 mb-3">
            <h5>📊 Reservation Summary</h5>
            <hr />
            <p>Total Reservations: {total}</p>
            <p className="text-warning">Booked: {booked}</p>
            <p className="text-success">Completed: {completed}</p>
            <p className="text-danger">Cancelled: {cancelled}</p>
          </div>

          {/* LIVE ACTIVITY */}
          <div className="card shadow p-3">
            <h5>🔔 Live Activity</h5>
            <hr />

            <div style={{ maxHeight: "250px", overflowY: "auto" }}>

              {reservations.slice(0, 5).map(r => (
                <div key={r.id} className="border-bottom pb-2 mb-2">
                  <strong>{r.name}</strong>
                  <br />
                  <small>
                    Room Table Booking → <b>{r.status}</b>
                  </small>
                </div>
              ))}

            </div>
          </div>

        </div>

      </div>

    </div>
  );
}