import { useApp } from "../../context/AppContext";

export default function Header({ toggleSidebar }) {
  const { mode, toggleMode } = useApp();

  return (
    <div className="header d-flex justify-content-between align-items-center p-2 bg-white shadow-sm">

      {/* ☰ BUTTON */}
      <button className="btn btn-dark d-md-none" onClick={toggleSidebar}>
        ☰
      </button>

      <h5 className="m-0 d-none d-md-block">
        {mode === "lodge" ? "Lodge Dashboard 🏨" : "Restaurant Dashboard 🍽️"}
      </h5>

      <button className="btn btn-warning btn-sm" onClick={toggleMode}>
  {mode === "lodge" ? "Switch to Restaurant 🍽️" : "Switch to Lodge 🏨"}
</button>

    </div>
  );
}