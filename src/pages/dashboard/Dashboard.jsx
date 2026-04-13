import { useState, useEffect } from "react";
import { useApp } from "../../context/AppContext";
import { Link, useLocation } from "react-router-dom";
import { useNavigate } from "react-router-dom";
import axios from "axios";
export default function Dashboard() {
  const { mode } = useApp();
  const location = useLocation();
  const navigate = useNavigate();
  const [stats, setStats] = useState({
    roomsCleaning: 0,
    roomServiceOrders: 0,
    occupiedRooms: 0
  });
  useEffect(() => {
    fetchStats();
  }, []);

  const fetchStats = async () => {
    try {
      const res = await axios.get("http://localhost:5000/api/dashboard/stats");
      setStats(res.data);
    } catch (err) {
      console.log(err);
    }
  };

  // Get current page name
  const path = location.pathname.split("/")[1];

  const pageName = path
    ? path.replace("-", " ").replace("_", " ")
    : "dashboard";

  return (
    <>
      {/* HEADER */}
      <div className="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h2 className="page-title">Welcome Back, Admin!</h2>
          <p className="text-muted d-flex align-items-center gap-2">
            <i className="bi bi-house-door-fill"></i>
            <span>Home</span>

            <i className="bi bi-chevron-right"></i>

            <i className="bi bi-building"></i>
            <span>
              {mode === "lodge" ? "Lodge Dashboard" : "Restaurant Dashboard"}
            </span>
          </p>
        </div>

        <button className="btn btn-warning">
          + New {mode === "lodge" ? "Booking" : "Order"}
        </button>
      </div>

      {/* 🔥 CARDS */}
      <div className="row">
        {mode === "lodge" ? (
          <>
            <Card title="Total Revenue" value="₹145,000" icon="bi-cash" />
            <Card title="Rooms Occupied" value="18 / 30" icon="bi-door-open" />
            <Card title="Check-ins Today" value="5" icon="bi-box-arrow-in-right" />
            <Card title="Pending Verifications" value="2" icon="bi-shield-exclamation" />
          </>
        ) : (
          <>
            <Card title="Total Sales" value="₹85,000" icon="bi-cash-stack" />
            <Card title="Orders Today" value="120" icon="bi-basket" />
            <Card title="Active Tables" value="15 / 25" icon="bi-grid" />
            <Card title="Pending Orders" value="8" icon="bi-hourglass" />
          </>
        )}
      </div>

      {/* 🔥 SECOND ROW */}
      <div className="row mt-3">
        {mode === "lodge" ? (
          <>
            <Card title="Rooms Cleaning" value={stats.roomsCleaning} icon="bi bi-bucket-fill" />
            <Card title="Room Service Orders" value={stats.roomServiceOrders} icon="bi bi-box-seam-fill" />
            <Card title="Bills Pending" value={stats.occupiedRooms} icon="bi bi-receipt" />
          </>
        ) : (
          <>
            <Card title="Kitchen Active Orders" value="10" />
            <Card title="Low Stock Items" value="3" />
          </>
        )}
      </div>

      {/* 🔥 TABLE + QUICK ACTIONS */}
      <div className="row mt-4">

        {/* LEFT TABLE */}
        <div className="col-md-8">
          <div className="card card-premium">
            <div className="card-header bg-danger text-white">
              {mode === "lodge" ? "Recent Activities" : "Recent Orders"}
            </div>

            <table className="table">
              <thead>
                {mode === "lodge" ? (
                  <tr>
                    <th>Guest</th>
                    <th>Room</th>
                    <th>Status</th>
                    <th>Amount</th>
                  </tr>
                ) : (
                  <tr>
                    <th>Order ID</th>
                    <th>Table</th>
                    <th>Status</th>
                    <th>Total</th>
                  </tr>
                )}
              </thead>

              <tbody>
                {mode === "lodge" ? (
                  <tr>
                    <td>Rahul</td>
                    <td>101</td>
                    <td>Checked In</td>
                    <td>₹3500</td>
                  </tr>
                ) : (
                  <tr>
                    <td>#1023</td>
                    <td>Table 5</td>
                    <td>Preparing</td>
                    <td>₹850</td>
                  </tr>
                )}
              </tbody>
            </table>
          </div>
        </div>

        {/* RIGHT QUICK ACTIONS */}
        <div className="col-md-4">
          <div className="card card-premium">
            <div className="card-header bg-warning">
              Quick Actions
            </div>

            <div className="p-3 d-flex flex-column gap-2">

              {mode === "lodge" ? (
                <>
                  <button
                    className="btn btn-light"
                    onClick={() => navigate("/housekeeping")}
                  >
                    <i className="bi bi-bucket me-2"></i> HouseKeeping
                  </button>

                  <button
                    className="btn btn-light"
                    onClick={() => navigate("/room-service")}
                  >
                    <i className="bi bi-basket me-2"></i> Room Service
                  </button>

                  <button
                    className="btn btn-light"
                    onClick={() => navigate("/room-billing")}
                  >
                    <i className="bi bi-receipt me-2"></i> Room Billing
                  </button>

                  <button
                    className="btn btn-light"
                    onClick={() => navigate("/amenity")}
                  >
                    <i className="bi bi-gift me-2"></i> Amenity Management
                  </button>

                  <button
                    className="btn btn-light"
                    onClick={() => navigate("/room_avail")}
                  >
                    <i className="bi bi-calendar-check me-2"></i> Room Availability
                  </button>
                </>
              ) : (
                <>
                  <button className="btn btn-light">
                    <i className="bi bi-cash-stack me-2"></i> Billing</button>
                  <button className="btn btn-light">
                    <i className="bi bi-box-seam me-2"></i> Inventory</button>
                  <button className="btn btn-light">
                    <i className="bi bi-truck me-2"></i> Supplier</button>
                  <button className="btn btn-light">
                    <i className="bi bi-cart-check me-2"></i> Purchase</button>

                  <button className="btn btn-light">
                    <i className="bi bi-calendar-event me-2"></i> Reservation
                  </button>
                </>
              )}

            </div>
          </div>
        </div>

      </div>
    </>
  );
}

/* CARD COMPONENT */
function Card({ title, value, icon }) {
  return (
    <div className="col-md-3">
      <div className="card card-premium p-3 d-flex justify-content-between align-items-center">
        <div>
          <h6>{title}</h6>
          <h4>{value}</h4>
        </div>
        {icon && <i className={`bi ${icon} fs-3`}></i>}
      </div>
    </div>
  );
}