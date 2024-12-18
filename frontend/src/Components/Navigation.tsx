// add route home and about
import React from "react";
import { Link, NavLink } from "react-router-dom";

const Navigation = () => {
  return (
    <nav className="pd-5 mb-5 border-b navigation">
      <ul className="flex justify-center space-x-5">
        <li>
          <NavLink to="/">Home</NavLink>"
        </li>
        <li>
          <NavLink to="/about">About</NavLink>"
        </li>
      </ul>
    </nav>
  );
};

export default Navigation;
