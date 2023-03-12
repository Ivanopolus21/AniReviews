def sort(array):
    length = len(array)
    for j in range(0, length-1):
        for i in range(0, length-j-1):
            if array[i].rate < array[i+1].rate:
                array[i], array[i+1] = array[i+1], array[i]
    return array

def printing(array):
    for i in range(0, len(array)):
        number = i + 1
        print( f"{number}" + ":" + array[i].title, array[i].rate)

class Review:
    def __init__(self, title, rate):
        self.title = title
        self.rate = rate

        
reviews = [Review('Demon Slayer', 9.25), Review('Erased', 7.75), Review('Mirai Nikki', 8), Review('Tokyo Godfathers', 8.6), Review('The Promised Neverland', 9.2), Review('Overlord', 7.6), Review('Overlord 2', 8), Review('Overlord 3', 7.6), Review('The Rising of the Shield Hero', 8.2), Review('Isekai Quartet 1-2', 7.5), Review('Boogiepop and the Others', 8), Review('The Promised Neverland 2', 6.6), Review('Soul Eater', 7.4), Review('Wonder Egg Priority', 8.6), Review('Demon Slayer:Mugen Train', 8.4), Review('Hunter x Hunter (2011)', 8.6), Review('Great Teacher Onizuka', 7.8), Review("Kiki's Delivery Service", 7.8), Review('Psycho-Pass', 7.25), Review('Psycho-Pass', 7.4), Review('Psycho-Pass: Tsumi to Batsu', 8), Review('Psycho-Pass: First Guardian', 7), Review('Psycho-Pass: The Movie', 8.2), Review('Psycho-Pass: Onshuu no Kanata ni', 8.4), Review('Psycho-Pass 3', 8.75), Review('Psycho-Pass 3: First Inspector', 8), Review("Jojo's Bizzare Adventure", 8.6), Review('Konosuba', 8.5), Review('Death Note', 8.4), Review('Charlotte',  7.8), Review('No Game No Life',  8.2), Review('Kaguya-Sama: Love is War', 8), Review('Neon Genesis Evangelion', 8), Review('Elfen Lied', 7.8), Review('Assassination Classroom', 8.6), Review('Code Geass', 8.8), Review('Noragami', 7.6), Review('Konosuba: Legend of Crimson', 9.2), Review('K-ON!', 8.7), Review('Re:Zero', 8.2), Review('The Shape of Voice', 9), Review('Musaigen no Phantom World', 7.8), Review('Your Name', 8.4), Review('Serial Experiments Lain', 7.25), Review('One-Punch Man', 9), Review('Angel Beats', 8.8), Review('My Neighbor Totoro', 7.6), Review('Kaguya-sama: Love is War 2', 8.8), Review('Guilty Crown', 8.2), Review('Toradora!', 8.6), Review('Merc Storia', 7), Review('Akame ga Kill', 7.8), Review('Black Lagoon', 8.4), Review('Tokyo Ghoul', 8.25), Review('Tokyo Ghoul √A', 6), Review('Tokyo Ghoul: re', 7.2), Review('Spice and Wolf', 7.8), Review('Weathering with You', 9.2), Review('Happy Sugar Life', 7.8), Review('The Saga of Tanya the Evil', 8.5), Review('Ergo Proxy', 9.2), Review('Boku no Hero Academia', 8.4), Review('Boku no Hero Academia 2', 8.8), Review('Boku no Hero Academia 3', 9), Review('Boku no Hero Academia 4', 8.8)]

old_reviews = [Review('Dedman Wonderland (old)', 9), Review('Violet Evergarden (old)', 9.9), Review('Madoka Magica', 9.6), Review('Black Bullet (old)', 8.7), Review('Parasyte (old)', 9.3), Review('Dororo (old)', 9.9), Review('Dr. Stone (old)', 9.3), Review('Fullmetal Alchemist: Brotherhood (old)', 10)]

printing(sort(reviews))