import { Link } from "@inertiajs/react";
import Dropdown from "./Dropdown";

function Navbar({ auth }) {
    return (
        <nav className="bg-gray-800 p-4">
            <div className="container mx-auto">
                <div className="flex items-center justify-between">
                    <Link
                        href={route("home")}
                        className="text-white text-xl font-bold"
                    >
                        mobillium blog
                    </Link>

                    <div className="flex items-center space-x-4">
                        <Dropdown>
                            <Dropdown.Trigger>
                                <span className="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        className="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                    >
                                        {auth.user?.name}

                                        <svg
                                            className="ms-2 -me-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fillRule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clipRule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </Dropdown.Trigger>

                            <Dropdown.Content>
                                <Dropdown.Link href={route("profile.edit")}>
                                    Profile
                                </Dropdown.Link>
                                <Dropdown.Link
                                    href={route("logout")}
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </Dropdown.Link>
                            </Dropdown.Content>
                        </Dropdown>

                        {auth.user && auth.user.has_admin_role && (
                            <Link
                                href={route("admin.dashboard")}
                                className="text-white"
                            >
                                Admin Panel
                            </Link>
                        )}

                        {auth.user && auth.user.has_author_role && (
                            <Link
                                href={route("authors.index")}
                                className="text-white"
                            >
                                Author Panel
                            </Link>
                        )}
                    </div>
                </div>
            </div>
        </nav>
    );
}

export default Navbar;
