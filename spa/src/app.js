import {h, render} from 'preact';
import {Router, Link} from 'preact-router';
import Home from './pages/home';
import Conference from './pages/conferences';
import '../assets/css/app.scss';
import {useState, useEffect} from 'preact/hooks';
import {findConferences} from './api/api';


function App() {
    const [conferences, setConferences] = useState(null);

    useEffect(() => {
        findConferences().then((conferences) => setConferences(conferences));
    }, []);

    if (conferences === null) {
        return <div classname="text-center pt-5">Loading...</div>;
    }

    return (
        <div>
            <header classname="header">
                <nav className="navbar navbar-light bg-light">
                    <div className="container">
                        <Link className="navbar-brand mr-4 pr-2" href="/">
                            &#128217; Guestbook
                        </Link>
                    </div>
                </nav>

                <nav className="bg-light border-bottom text-center">
                    {conferences.map((conference) => (
                        <Link classname="nav-conference" href={'/conference/'+conference.slug}>
                            {conference.city} {conference.year}
                        </Link>
                    ))}
                </nav>
            </header>

            <Router>
                <Home path="/" conferences={conferences}/>
                <Conference path="/conference/:slug" conferences={conferences}/>
            </Router>
        </div>

    )
}

render(<App />, document.getElementById('app'));
