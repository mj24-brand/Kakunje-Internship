import { useApp } from "../../context/AppContext";
import { NavLink } from "react-router-dom";
import logo from "../../assets/logo.png";

export default function Sidebar({ isOpen, closeSidebar }) {
  const { mode } = useApp();

  const handleClick = () => {
    if (closeSidebar) closeSidebar();
  };

  return (
    <div className={`sidebar ${isOpen ? "active" : ""}`}>

      <button
        className="btn btn-sm btn-light position-absolute top-0 end-0 m-2 d-md-none"
        onClick={closeSidebar}
      >
        ✖
      </button>

      {/* LOGO */}
      <div className="text-center mb-4 pt-3">
        <img src={logo} alt="Logo" style={{ width: "120px" }} />
      </div>

      {/* DASHBOARD */}
      <NavLink to="/" onClick={handleClick} className="nav-link">
        <i className="bi bi-speedometer2 me-2"></i> Dashboard
      </NavLink>

      {mode === "lodge" ? (
        <>

          <h6 className="mt-3 text-muted">Lodge</h6>

          <NavLink to="/housekeeping" onClick={handleClick} className="nav-link">
            <i className="bi bi-bucket me-2"></i>
            Housekeeping
          </NavLink>

          <NavLink to="/room-service" onClick={handleClick} className="nav-link">
            <i className="bi bi-basket me-2"></i>
            Room Service
          </NavLink>

          <NavLink to="/room-billing" onClick={handleClick} className="nav-link">
            <i className="bi bi-receipt me-2"></i>
            Room Billing
          </NavLink>

          <NavLink to="/amenity" onClick={handleClick} className="nav-link">
            <i className="bi bi-gift me-2"></i>
            Amenity
          </NavLink>

          <NavLink to="/room_avail" onClick={handleClick} className="nav-link">
            <i className="bi bi-calendar-check me-2"></i>
            Availability
          </NavLink>
        </>
      ) : (
        <>
          <h6 className="mt-3 text-muted">Restaurant</h6>

          <NavLink to="/billing" onClick={handleClick} className="nav-link">
            <i className="bi bi-cash-stack me-2"></i>
            Billing
          </NavLink>

          <NavLink to="/inventory" onClick={handleClick} className="nav-link">
            <i className="bi bi-box-seam me-2"></i>
            Inventory
          </NavLink>

          <NavLink to="/supplier" onClick={handleClick} className="nav-link">
            <i className="bi bi-truck me-2"></i>
            Supplier
          </NavLink>

          <NavLink to="/purchase" onClick={handleClick} className="nav-link">
            <i className="bi bi-cart-check me-2"></i>
            Purchase
          </NavLink>

          <NavLink to="/reservation" onClick={handleClick} className="nav-link">
            <i className="bi bi-calendar-event me-2"></i>
            Reservation
          </NavLink>
        </>
      )}

      <hr />

      <NavLink to="/logout" onClick={handleClick} className="nav-link text-danger">
        <i className="bi bi-box-arrow-right me-2"></i>
        Logout
      </NavLink>

    </div>
  );
}