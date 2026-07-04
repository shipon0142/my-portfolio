import './style.css';
import { portfolioData } from './data.js';
import renderNav from './sections/nav.js';
import renderHero from './sections/hero.js';
import renderAbout from './sections/about.js';
import renderSkills from './sections/skills.js';
import renderProjects from './sections/projects.js';
import renderExperience from './sections/experience.js';
import renderEducation from './sections/education.js';
import renderCertifications from './sections/certifications.js';
import renderContact from './sections/contact.js';
import renderFooter from './sections/footer.js';
import { initReveal } from './lib/reveal.js';
import { initScrollSpy } from './lib/scroll-spy.js';

const app = document.getElementById('app');

app.innerHTML = [
  renderNav(portfolioData),
  '<main id="main">',
  renderHero(portfolioData),
  renderAbout(portfolioData),
  renderSkills(portfolioData),
  renderProjects(portfolioData),
  renderExperience(portfolioData),
  renderEducation(portfolioData),
  renderCertifications(portfolioData),
  renderContact(portfolioData),
  '</main>',
  renderFooter(portfolioData),
].join('');

initReveal('.reveal');
initScrollSpy('header nav a[href^="#"]', 'main > section[id]');

const toggle = document.querySelector('[data-menu-toggle]');
const menu = document.querySelector('[data-mobile-menu]');
if (toggle && menu) {
  toggle.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
  document.querySelectorAll('[data-mobile-link]').forEach((link) => {
    link.addEventListener('click', () => menu.classList.add('hidden'));
  });
}
