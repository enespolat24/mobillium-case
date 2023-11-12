import { Link } from "@inertiajs/react";
import Navbar from "@/Components/Navbar";

const Home = ({ auth, posts }) => {
    return (
        <>
            <Navbar auth={auth}></Navbar>
            <div className="max-w-4xl mx-auto p-8">
                <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                    {posts.data.map((post, key) => (
                        <Link key={key} href={route("posts.view", post.slug)}>
                            <div className="bg-white overflow-hidden shadow-sm rounded-lg">
                                <div className="px-6 py-4">
                                    <div className="font-semibold text-xl mb-2">
                                        {post.title}
                                    </div>
                                    <p className="text-gray-700 text-base">
                                        {post.content}
                                    </p>
                                </div>
                            </div>
                        </Link>
                    ))}
                </div>

                <div className="mt-4 text-center">
                    {posts.links.map((link, key) => (
                        <Link
                            key={key}
                            href={link.url}
                            className={`text-xs mr-2 px-2 py-1 rounded-md ${
                                link.active
                                    ? "bg-blue-500 text-white"
                                    : "bg-gray-200"
                            }`}
                            dangerouslySetInnerHTML={{ __html: link.label }}
                        ></Link>
                    ))}
                </div>
            </div>
        </>
    );
};

export default Home;
