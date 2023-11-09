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

                    <div className="space-x-4">
                        {auth.user.has_admin_role && (
                            <Link
                                href={route("admin.dashboard")}
                                className="text-white"
                            >
                                Admin Panel
                            </Link>
                        )}
                        {auth.user.has_author_role && (
                            <Link href="/author-panel" className="text-white">
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
