import { Link } from "@inertiajs/react";
function Navbar({ auth }) {
    console.log(auth);
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

                    {auth.user &
                    (
                        <>
                            <Link
                                href={route("login")}
                                className="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >
                                Log in
                            </Link>

                            <Link
                                href={route("register")}
                                className="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >
                                Register
                            </Link>
                        </>
                    )}

                    <div className="space-x-4">
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
